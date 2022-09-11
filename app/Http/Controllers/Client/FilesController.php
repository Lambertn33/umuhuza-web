<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notary;

class FilesController extends Controller
{
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
        return $request->all();
    }
}
