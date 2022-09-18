<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Services\Common\AccountStatus;
use Illuminate\Http\Request;
use App\Models\Notary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NotariesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['adminMiddleware','auth.session']);
    }

    //APPROVED NOTARIES
    public function getApprovedNotaries()
    {
        $approvedNotaries = Notary::where('status', \App\Models\Notary::APPROVED)->get();
        return view('administrator.notaries.approved.index', compact('approvedNotaries'));
    }

    public function changeAccountStatus($notaryId)
    {
        try {
            $notary = Notary::find($notaryId);
            $user = $notary->user;
            return (new AccountStatus)->changeAccountStatus($user);
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()->with('error','an error occured..please try again');
        }
    }

    public function getNotaryFiles($notaryId)
    {
        $notary = Notary::find($notaryId);
        $notaryFiles =  $notary->myFiles();
        return view('administrator.notaries.approved.files.uploaded', compact('notary','notaryFiles'));
    }

    public function getNotaryTaggedFiles($notaryId)
    {
        $notary = Notary::find($notaryId);
        $notaryTaggedFiles =  $notary->receivedFiles()->get(); 
        return view('administrator.notaries.approved.files.tagged', compact('notary','notaryTaggedFiles'));
    }

    //PENDING NOTARIES

    public function getPendingNotaries()
    {
        $pendingNotaries = Notary::where('status', \App\Models\Notary::PENDING)->get();
        return view('administrator.notaries.pending.index', compact('pendingNotaries'));
    }

    public function getPendingNotaryInfo($id)
    {
        $pendingNotary = Notary::with('user')->find($id);
        return view('administrator.notaries.pending.show', compact('pendingNotary'));
    }

    public function downloadNotaryNationalId($id, $disk)
    {
        $notary = Notary::find($id);
        $filename = Str::random(6);
        $path = Storage::disk($disk)->path($notary->national_id_photocopy);
        $type = mime_content_type($path);

        $header = [
            'Content-Type'        => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ];
        return response()->file($path, $header);
    }
}
