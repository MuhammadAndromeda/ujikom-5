<?php

namespace App\Filament\Resources\Products\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;

class SalesSummaryWidget extends BaseWidget
{
    protected static ?string $heading = 'Product Sales Summary';

    protected int | string | array $columnSpan = 'full';

    public function getTableRecordKey(Model|array $record): string
    {
        return $record->material;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Sales::query()
                ->select(
                    'material',
                    DB::raw('SUM(quantity) as total_quantity'),
                    DB::raw('SUM(price) as total_revenue')
                )
                ->groupBy('material')
            )
            ->columns([
                Tables\Columns\TextColumn::make('material')
                    ->label('Nama Produk')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'pasir_halus'    => 'Pasir Halus',
                        'sirtu'          => 'Sirtu',
                        'kerikil_kotor'  => 'Kerikil Kotor',
                        'kerikil_bersih' => 'Kerikil Bersih',
                        'pasir_sungai'   => 'Pasir Sungai',
                        default          => $state,
                    }),

                Tables\Columns\TextColumn::make('total_quantity')
                    ->label('Total Terjual (M3)')
                    ->suffix(' M3')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Total Pendapatan')
                    ->money('idr', true)
                    ->alignCenter(),
            ]);
    }
}