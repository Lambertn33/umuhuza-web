<?php

namespace App\Http\Controllers\Administrator;

use App\Charts\Admin\NotariesChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notary;
use App\Models\Client;
use App\Models\File;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['adminMiddleware','auth.session']);
    }

    public function getAdminDashboardOverview(NotariesChart $chart)
    {
        $notariesChart = $chart->build();
        $totalNotaries = Notary::count();
        $totalClients = Client::count();
        $totalFiles = File::count();
        $latestNotaries = Notary::with('user')->latest()->limit(5)->get();
        return view('administrator.dashboard', compact('notariesChart', 'totalNotaries', 'totalClients', 'totalFiles','latestNotaries'));
    }
}
