<?php

namespace App\Http\Controllers\Client;

use App\Charts\Client\ClientFilesChart;
use App\Http\Controllers\Controller;
use App\Models\File_Sending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['clientMiddleware','auth.session']);
    }

    public function getClientDashboardOverview(ClientFilesChart $chart)
    {
        $authenticatedClient = Auth::user()->client;
        $clientFilesChart = $chart->build();
        $myTotalFiles = $authenticatedClient->myFiles()->count();
        $myLatestFiles = File::with('sending')->where('owner', $authenticatedClient->id)->latest()->limit(5)->get();
        $myUnreadFiles = File_Sending::where('client_id', $authenticatedClient->id)->where('status', \App\Models\File_Sending::PENDING)->count();
        $myReadFiles = File_Sending::where('client_id', $authenticatedClient->id)->where('status', \App\Models\File_Sending::RECEIVED)->count();
        return view('client.dashboard', compact('clientFilesChart','myTotalFiles','myUnreadFiles','myReadFiles','myLatestFiles','authenticatedClient'));
    }
}
