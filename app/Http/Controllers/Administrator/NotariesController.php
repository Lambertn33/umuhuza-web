<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notary;
use App\Models\File;

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
}
