<?php

namespace App\Filament\Resources\Sales\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use function Illuminate\Support\days;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer')
                    ->label("Customer Name"),
                TextColumn::make('material')->badge()
                    ->color(fn (string $state): string => match($state) {
                        'pasir_halus'    => 'gray',
                        'sirtu'          => 'gray',
                        'kerikil_kotor'  => 'gray',
                        'kerikil_bersih' => 'gray',
                        'pasir_sungai'   => 'gray',
                    })->label('Material Name'),
                TextColumn::make('quantity')
                    ->label("(QTY/M3)")
                    ->suffix(' M3')
                    ->alignCenter(),
                TextColumn::make('rit')
                    ->label("(Rit)")
                    ->alignCenter(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('idr', true),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'cash'     => 'success',
                        'transfer' => 'info',
                        'unpaid'   => 'warning',
                        'debt'     => 'danger',
                        default    => 'gray',
                    })->label('Payment Status'),
                TextColumn::make('sales_date')
                    ->label('Sales Date')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
