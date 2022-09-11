<?php

namespace App\Http\Controllers\Notary;

use App\Http\Controllers\Controller;
use App\Http\Services\Common\FileDownload;
use App\Http\Services\Notary\CreateFileCode;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\File_Confirmation;
use App\Models\File_Confirmation_User;
use App\Models\Notary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Common\FileStoring;
use App\Http\Services\Notary\GenerateConfirmationCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('notaryMiddleware');
    }

    public function myNotaryFiles()
    {
        $authenticatedNotary = Auth::user()->notary;
        $myUploadedFiles = $authenticatedNotary->myFiles();
        return view('notary.files.uploaded.uploadedFiles', compact('authenticatedNotary','myUploadedFiles'));
    }

    public function addNewNotaryFile()
    {
        $authenticatedNotary = Auth::user()->notary;
        $fileCode =  (new CreateFileCode())->createFileCode($authenticatedNotary);
        return view('notary.files.uploaded.upload', compact('authenticatedNotary','fileCode'));
    }

    public function saveNewNotaryFile(Request $request)
    {
        try {
            DB::beginTransaction();
            $notaryTelephone =  Auth::user()->telephone;
            $notaryId = Auth::user()->notary->id;
            $title = $request->title;
            $code = $request->code;
            $names = $request->names;
            $national_ids = $request->national_ids;
            $telephones = $request->telephones;
            $uploadedFile = '';
            $usersToConfirm = [];
            if ($request->hasFile('document')) {
                $uploadedFile = (new FileStoring)->storeFile($request, 'document', $notaryTelephone, 'notary_uploaded_files');
                //$uploadedFile = '12345';
            }

            $newFile = [
                'id' => Str::uuid()->toString(),
                'owner' => $notaryId,
                'filename' => $title,
                'file_path' => $uploadedFile,
                'file_number' => $code,
                'file_type' => \App\Models\File::NOTARY_UPLOAD,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $newFileConfirmation = [
                'id' => Str::uuid()->toString(),
                'file_id' => $newFile['id'],
                'created_at' => now(),
                'updated_at' => now()
            ];
            for ($i=0; $i < count($telephones) ; $i++) { 
                $usersToConfirm[] = [
                    'id' => Str::uuid()->toString(),
                    'file_confirmation_id' => $newFileConfirmation['id'],
                    'names' => $names[$i],
                    'telephone' => $telephones[$i],
                    'national_id' => $national_ids[$i],
                    'status' => \App\Models\File_Confirmation_User::PENDING,
                    'confirmation_code' => rand(100000, 999999),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            File::insert($newFile);
            File_Confirmation::insert($newFileConfirmation);
            foreach ($usersToConfirm as $user) {
                File_Confirmation_User::insert($user);
                //TODO create Job to send SMS to users using telephone and confirmation code 
            }
            DB::commit();
            return redirect()->route('getFileToConfirm',$newFileConfirmation['id']);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()->with('danger','an error occured...please try again');
        }
    }

    public function getFileToConfirm(Request $request, $id)
    {
        if (!File_Confirmation::find($id)) {
            abort(404);
        }
        $fileConfirmation = File_Confirmation::find($id);
        $users = $fileConfirmation->confirmation_users()->get();
        $file = $fileConfirmation->file;
        return view('notary.files.uploaded.usersConfirm', compact('fileConfirmation','users','file'));
    }

    public function confirmFileUsers(Request $request, $id)
    {
        if (!File_Confirmation::find($id)) {
            abort(404);
        }
        $userIds = $request->userIds;
        $confirmationCodes = $request->confirmationCodes;
        for ($i=0; $i <count($userIds); $i++) { 
            $checkConfirmationUser = File_Confirmation_User::find($userIds[$i]);
            if ($checkConfirmationUser->confirmation_code !== $confirmationCodes[$i]) {
                return back()->withInput()->with('error',"the confirmation code provided for ".$checkConfirmationUser->names." is incorrect");
            } 
        }
        for ($i=0; $i <count($userIds); $i++) { 
            $checkConfirmationUser = File_Confirmation_User::find($userIds[$i]);
            try {
                DB::beginTransaction();
                $checkConfirmationUser->update([
                    'status' => \App\Models\File_Confirmation_User::APPROVED
                ]);
                DB::commit();
            } catch (\Throwable $th) {
               DB::rollback();
               return back()->withInput()->with('danger','an error occured...please try again');
            }
        }
        return redirect()->route('myNotaryFiles')->with('success','File Confirmed and saved successfully');
    }

    public function downloadFile($file){
        $fileToDownload = File::find($file);
        return (new FileDownload)->downloadFile($fileToDownload);
    }
}