<?php

namespace App\Filament\Resources\SalesReports\Tables;

use Carbon\Carbon;
// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;

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
                    ->money('idr', true),

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
                        DatePicker::make('search_date')
                            ->label('Search by Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['search_date'],
                            fn (Builder $query, $date): Builder => $query->whereDate('sales_date', '>=', $date),
                        );
                    })
                    ->indicateUsing(function (array $data): array {
                        if ($data['search_date'] ?? null) {
                            return ['search_date' => 'Tanggal:' . Carbon::parse($data['search_date'])->format('d M Y')];
                        }
                        return [];
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
