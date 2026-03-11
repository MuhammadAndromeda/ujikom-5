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
                    ->badge()
                    ->color('gray')
                    ->label('Nama Material'),
                 
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

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
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
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
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
