<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminMiddleware');
    }

    public function getAdminDashboardOverview()
    {
        return view('administrator.dashboard');
    }
}
