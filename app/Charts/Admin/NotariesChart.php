<?php

namespace App\Charts\Admin;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Notary;

class NotariesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $approvedNotaries = Notary::where('status', \App\Models\Notary::APPROVED)->count();
        $pendingNotaries = Notary::where('status', \App\Models\Notary::PENDING)->count();
        $rejectedNotaries = Notary::where('status', \App\Models\Notary::REJECTED)->count();
        return $this->chart->pieChart()
            ->addData([
                $approvedNotaries,
                $pendingNotaries,
                $rejectedNotaries
            ])
            ->setLabels(['Approved Notaries', 'Pending Notaries', 'Rejected Notaries']);
    }
}
