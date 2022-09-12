<?php

namespace App\Charts\Client;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;
use App\Models\File_Sending;
use App\Models\File;

class ClientFilesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $authenticatedClient = Auth::user()->client;
        $myTotalFiles = File::where('owner', $authenticatedClient->id)->count();
        $myUnreadFiles = File_Sending::where('client_id', $authenticatedClient->id)->where('status', \App\Models\File_Sending::PENDING)->count();
        $myReadFiles = File_Sending::where('client_id', $authenticatedClient->id)->where('status', \App\Models\File_Sending::RECEIVED)->count();
        return $this->chart->pieChart()
            ->addData([$myTotalFiles, $myUnreadFiles, $myReadFiles])
            ->setLabels(['Total Files','Pending Files', 'Processed Files']);
    }
}
