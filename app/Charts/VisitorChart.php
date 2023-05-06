<?php

namespace App\Charts;

use App\Models\Pengunjung;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class VisitorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $visitor = [
            Pengunjung::whereYear('updated_at', date('Y'))->sum('02'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('01'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('03'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('04'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('05'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('06'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('07'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('08'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('09'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('10'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('11'),
            Pengunjung::whereYear('updated_at', date('Y'))->sum('12'),
        ];

        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        return $this->chart->barChart()
            ->setTitle('Statistik Pengunjung Website Tahun ' . date('Y'))
            // ->setSubtitle('Statistik Pengunjung')
            ->addData('Total Pengunjung', $visitor)
            // ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis($bulan);
    }
}
