<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Services\Common\FileDownload;
use App\Http\Services\Common\FileOwner;
use App\Http\Services\Common\ValidateInputs;
use App\Jobs\SMS\Common\FileAccessRequest;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\File_Access_Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileSearchController extends Controller
{
    public function getFileSearchPage(Request $request)
    {
        $request->session()->flush();
        return view('file_search.index');
    }

    public function searchFile(Request $request)
    {
        $phoneFormat = 2507;
        $phoneTotalDigits = 12;
        $data = $request->all();
        if (!(new ValidateInputs)->validatePhoneNumber($data['telephone'], $phoneFormat, $phoneTotalDigits)) {
            return back()->withInput()->with('error','The Telephone number must start with '. $phoneFormat .'... and consists of '.$phoneTotalDigits.' digits');
        }

        try {
           DB::beginTransaction();
           $fileToSearch = File::where('file_number', $data['file_number']);
           if (!$fileToSearch->exists()) {
            return back()->withInput()->with('error',"The file with such file number doesn't exist");
           } else {
                $file = $fileToSearch->first();
                $fileNotary = (new FileOwner)->getFileNotary($file);
                $newFileAccessRequest = [
                    'id' => Str::uuid()->toString(),   
                    'file_id' => $file->id,
                    'requested_by' => $data['names'],
                    'telephone' => $data['telephone'],
                    'notary' => $fileNotary->id,
                    'reason' => $data['reason'],
                    'created_at' => now(),
                    'updated_at' => now()                
                ];
            
                File_Access_Request::insert($newFileAccessRequest);
                dispatch(new FileAccessRequest($data['names'], $data['telephone'], $file, $fileNotary));
                $request->session()->put('searchFileData', $data);
                $request->session()->put('fileToSearch', $fileToSearch->first());
                DB::commit();
                return redirect()->route('getFileAccessCodePage');
           }
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()->with('error','an error occured...please try again');
        }
    }

    public function getFileAccessCodePage(Request $request)
    {
        if (!$request->session()->get('searchFileData') || !$request->session()->get('fileToSearch')) {
            return redirect()->route('getLoginPage');
        }
        $data = $request->session()->get('searchFileData');
        return view('file_search.codeInput', compact('data'));
    }

    public function provideFileAccessCode(Request $request)
    {
        if ((!$request->session()->get('searchFileData') || !$request->session()->get('fileToSearch'))) {
            return redirect()->route('getLoginPage');
        }
        $fileToSearch = $request->session()->get('fileToSearch'); 
        $enteredData = $request->session()->get('searchFileData');
        $searchRecord = File_Access_Request::where('file_id', $fileToSearch->id)
        ->where('telephone', $enteredData['telephone'])
        ->where('access_code', $request->code);
        if ($searchRecord->exists()) {
            $request->session()->put('searchRecord', $searchRecord->first());
        }

        return !$searchRecord->exists() ?
              back()->withInput()->with('error','the code provided for file access # ' .$fileToSearch->file_number.' is wrong'):
              redirect()->route('viewSearchedFile');
    }

    public function viewSearchedFile(Request $request)
    {
        if ((!$request->session()->get('searchFileData') || !$request->session()->get('fileToSearch'))) {
            return redirect()->route('getLoginPage');
        }
        $fileToView = $request->session()->get('fileToSearch');
        $searchRecord = $request->session()->get('searchRecord');
        $searchRecord = File_Access_Request::find($searchRecord->id);
        return view('file_search.fileView', compact('fileToView', 'searchRecord'));   
    }

    public function downloadSearchedFile(Request $request, $id)
    {
        $fileAccessRequest= File_Access_Request::find($id);
        $file = $fileAccessRequest->file;
        try {
           DB::beginTransaction();
           $disk = $file->file_type == \App\Models\File::NOTARY_UPLOAD ? "notary_uploaded_files" : "client_uploaded_files";
           $fileAccessRequest->update([
            'has_been_viewed' => 1
           ]);
           DB::commit();    
           $request->session()->flush();
           return (new FileDownload)->downloadFile($file, $disk);
        } catch (\Throwable $th) {
            return back()->with('error', 'an error occured...try download again');
        }
    }
}
