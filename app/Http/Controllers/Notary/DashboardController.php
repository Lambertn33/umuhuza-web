<?php

namespace App\Http\Controllers\Notary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('notaryMiddleware');
    }

    public function getNotaryDashboardOverview()
    {
        return view('notary.dashboard');
    }
}
