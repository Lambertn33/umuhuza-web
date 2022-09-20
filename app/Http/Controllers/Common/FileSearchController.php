<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
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
    public function getFileSearchPage()
    {
        return view('file_search.index');
    }

    public function searchFile(Request $request)
    {
        $phoneFormat = 2507;
        $phoneTotalDigits = 12;
        $fileNumber = $request->file_number;
        $telephone = $request->telephone;
        if (!(new ValidateInputs)->validatePhoneNumber($telephone, $phoneFormat, $phoneTotalDigits)) {
            return back()->withInput()->with('error','The Telephone number must start with '. $phoneFormat .'... and consists of '.$phoneTotalDigits.' digits');
        }

        try {
           DB::beginTransaction();
           $fileToSearch = File::where('file_number', $fileNumber);
           if (!$fileToSearch->exists()) {
            return back()->withInput()->with('error',"The file with such file number doesn't exist");
           } else {
                $file = $fileToSearch->first();
                $fileNotary = (new FileOwner)->getFileNotary($file);
                $newFileAccessRequest = [
                    'id' => Str::uuid()->toString(),   
                    'file_id' => $file->id,
                    'requested_by' => $request->names,
                    'telephone' => $request->telephone,
                    'notary' => $fileNotary->id,
                    'reason' => $request->reason,
                    'created_at' => now(),
                    'updated_at' => now()                
                ];
            
                File_Access_Request::insert($newFileAccessRequest);
                dispatch(new FileAccessRequest($request->names, $request->telephone, $file, $fileNotary));
                DB::commit();
                return "Good";
           }
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return back()->withInput()->with('error','an error occured...please try again');
        }
    }
}
