<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('clientMiddleware');
    }

    public function getClientDashboardOverview()
    {
        return view('client.dashboard');
    }
}
