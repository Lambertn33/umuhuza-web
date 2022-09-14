<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Services\Common\AccountStatus;
use Illuminate\Http\Request;
use App\Models\Notary;
use App\Models\File;
use Illuminate\Support\Facades\DB;

class NotariesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['adminMiddleware','auth.session']);
    }

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
}
