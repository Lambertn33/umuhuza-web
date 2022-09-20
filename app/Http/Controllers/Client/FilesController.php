<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Notary\CreateFileCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notary;
use App\Http\Services\Common\FileStoring;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\File;
use App\Models\File_Sending;
use App\Http\Services\Common\FileDownload;
use App\Jobs\SMS\Notary\FileTagged;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['clientMiddleware','auth.session'])->except('downloadFile');
    }
    
    public function myClientFiles()
    {
        $authenticatedClient = Auth::user()->client;
        $myUploadedFiles = $authenticatedClient->myFiles();
        return view('client.files.uploadedFiles', compact('authenticatedClient','myUploadedFiles'));
    }

    public function addNewClientFile()
    {
        $authenticatedClient = Auth::user()->client;
        $allApprovedNotaries = Notary::with('user')->where('status', \App\Models\Notary::APPROVED)->get();
        return view('client.files.upload', compact('authenticatedClient', 'allApprovedNotaries'));
    }
    public function saveNewClientFile(Request $request)
    {
        try {
            DB::beginTransaction();
            $authenticatedClient = Auth::user()->client;
            $title = $request->title;
            $notaryId = $request->notary;
            $notary = Notary::find($notaryId);
            $code = (new CreateFileCode)->createFileCode($notary);
            $uploadedDocumentFile = '';
            $uploadedNationalIdFile = '';
            if ($request->hasFile('document')) {
                $uploadedDocumentFile = (new FileStoring)->storeFile($request, 'document', $notary->telephone, 'client_uploaded_files');
            }
            if ($request->hasFile('national_id_photocopy')) {
                $uploadedNationalIdFile = (new FileStoring)->storeFile($request, 'national_id_photocopy', $authenticatedClient->telephone, 'client_photocopy_ids');
            }
            $newFile = [
                'id' => Str::uuid()->toString(),
                'owner' => $authenticatedClient->id,
                'filename' => $title,
                'file_path' => $uploadedDocumentFile,
                'file_number' => $code,
                'file_type' => \App\Models\File::CLIENT_UPLOAD,
                'created_at' => now(),
                'updated_at' => now()
            ];
        
            $newFileSending = [
                'id' => Str::uuid()->toString(),
                'file_id' => $newFile['id'],
                'client_id' => $authenticatedClient->id,
                'notary_id' => $notaryId,
                'status' => \App\Models\File_Sending::PENDING,
                'national_id_photocopy' => $uploadedNationalIdFile,
                'created_at' => now(),
                'updated_at' => now()
            ];
            File::insert($newFile);
            File_Sending::insert($newFileSending);
            DB::commit();
            dispatch(new FileTagged($authenticatedClient, $notary, $code));
            //TODO send SMS to notary that he received a file
            return redirect()->route('myClientFiles')->with('success','File sent to the selected notary successfully...');

        } catch (\Throwable $th) {
           DB::rollback();
           return back()->withInput()->with('danger','an error occured...please try again');
        }
       
    }

    public function deletePendingFile($file){
       try {
        DB::beginTransaction();
        $pendingFileToDelete = File::find($file);
        $filePath = $pendingFileToDelete->file_path;
        $nationalIdPath =  $pendingFileToDelete->sending->national_id_photocopy;
        if (Storage::disk('client_uploaded_files')->exists($filePath)) {
            Storage::disk('client_uploaded_files')->delete($filePath);
        }
        if (Storage::disk('client_photocopy_ids')->exists($nationalIdPath)) {
            Storage::disk('client_photocopy_ids')->delete($nationalIdPath);
        }
        $pendingFileToDelete->sending->delete();
        $pendingFileToDelete->delete();
        DB::commit();
        return back()->with('success','Pending File Deleted Successfully');
       } catch (\Throwable $th) {
          DB::rollback();
          return back()->with('danger','an error occured...please try again');
       }
    }

    public function downloadFile($file, $disk){
        $fileToDownload = File::find($file);
        return (new FileDownload)->downloadFile($fileToDownload, $disk);
    }

}
