<?php

namespace App\Charts\Notary;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\File;
use App\Models\File_Sending;
use Illuminate\Support\Facades\Auth;

class NotaryFilesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $authenticatedNotary = Auth::user()->notary;
        $myTotalUploadedFiles = $authenticatedNotary->myFiles()->count();
        $myTotalTaggedFiles = $authenticatedNotary->receivedFiles()->count();
        $myTotalReadTaggedFiles = File_Sending::where('notary_id', $authenticatedNotary->id)->where('status', \App\Models\File_Sending::RECEIVED)->count();
        $myTotalUnreadTaggedFiles = File_Sending::where('notary_id', $authenticatedNotary->id)->where('status', \App\Models\File_Sending::PENDING)->count();
        return $this->chart->pieChart()
            ->addData([$myTotalUploadedFiles, $myTotalTaggedFiles, $myTotalReadTaggedFiles, $myTotalUnreadTaggedFiles])
            ->setLabels(['Total Uploaded Files', 'Total Tagged Files', 'Total Tagged Read Files','Total Tagged Unread Files']);
    }
}
