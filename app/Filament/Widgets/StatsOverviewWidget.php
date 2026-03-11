<?php

namespace App\Filament\Widgets;

use App\Models\Sales;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalHariIni = Sales::whereDate('created_at', today())->sum('price');
        $totalTransaksiHariIni = Sales::whereDate('created_at', today())->count();
        $produkTerlaris = Sales::select('material', DB::raw('SUM(quantity) as total'))
            ->groupBy('material')
            ->orderByDesc('total')
            ->first();

        return [
            Stat::make('Total Penjualan Hari Ini', 'IDR ' . number_format($totalHariIni, 0, ',', '.'))
                ->description('Total pendapatan hari ini')
                ->color('success'),

            Stat::make('Total Transaksi Hari Ini', $totalTransaksiHariIni)
                ->description('Jumlah transaksi hari ini')
                ->color('info'),

            Stat::make('Produk Terlaris', $produkTerlaris ? ucwords(str_replace('_', ' ', $produkTerlaris->material)) : 'Belum ada data')
                ->description($produkTerlaris ? 'Total terjual: ' . $produkTerlaris->total . ' M3' : '-')
                ->color('warning'),
        ];
    }
}