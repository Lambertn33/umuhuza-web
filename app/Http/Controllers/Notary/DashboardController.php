<?php

namespace App\Http\Controllers\Notary;

use App\Charts\Notary\NotaryFilesChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\File_Sending;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('notaryMiddleware');
    }

    public function getNotaryDashboardOverview(NotaryFilesChart $chart)
    {
        $authenticatedNotary = Auth::user()->notary;
        $notaryFilesChart = $chart->build();
        $myTotalPendingFiles = File_Sending::where('notary_id', $authenticatedNotary->id)->where('status', \App\Models\File_Sending::PENDING)->count();
        $myTotalProcessedFiles = File_Sending::where('notary_id', $authenticatedNotary->id)->where('status', \App\Models\File_Sending::RECEIVED)->count();
        $myTotalFiles = $authenticatedNotary->myFiles()->count();
        $myLatestTaggedFiles = $authenticatedNotary->receivedFiles()->latest()->limit(5)->get();
        $myTotalConfirmedUsers = 0;
        return view('notary.dashboard', compact('notaryFilesChart','myTotalProcessedFiles','authenticatedNotary','myTotalPendingFiles','myTotalFiles','myLatestTaggedFiles'));
    }
}
