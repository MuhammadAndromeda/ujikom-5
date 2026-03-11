<?php

namespace App\Filament\Widgets;

use App\Models\Sales;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SalesChartWidget extends ChartWidget
{
    protected ?string $heading = 'Grafik Penjualan 7 Hari Terakhir';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Sales::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(price) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan (IDR)',
                    'data' => $data->pluck('total')->toArray(),
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->pluck('tanggal')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}