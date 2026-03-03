<?php

namespace App\Filament\Resources\SalesReports\Tables;

use Carbon\Carbon;
// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
// use Filament\Tables\Filters\Indicator;

class SalesReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer')
                    ->label('Nama Customer')
                    ->searchable(),
                
                TextColumn::make('material')
                    ->label('Jenis Material')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'pasir_halus'    => 'Pasir Halus',
                        'sirtu'          => 'Sirtu',
                        'kerikil_kotor'  => 'Kerikil Kotor',
                        'kerikil_bersih' => 'Kerikil Bersih',
                        'pasir_sungai'   => 'Pasir Sungai',
                        default          => $state,
                    }),
                 
                TextColumn::make('quantity')
                    ->label('Quantity (M3)')
                    ->suffix(' M3')
                    ->alignCenter(),

                TextColumn::make('rit')
                    ->label('Rit')
                    ->alignCenter(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr', true)
                    ->summarize(
                        Sum::make('summary')->label('Sales Total')->money('idr', true)
                    ),

                TextColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'cash'     => 'success',
                        'transfer' => 'info',
                        'unpaid'   => 'warning',
                        'debt'     => 'danger',
                        default    => 'gray',
                    }),

                TextColumn::make('sales_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('sales_date')
                    ->form([
                        DatePicker::make('from')
                            ->label('Dari Tanggal'),

                        DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sales_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sales_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'Dari: ' . Carbon::parse($data['from'])->format('d M Y');
                        }
                        if ($data['until'] ?? null) {
                            $indicators['until'] = 'Sampai: ' . Carbon::parse($data['until'])->format('d M Y');
                        }
                        return $indicators;
                    }),
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                //
            ]);
    }
}
