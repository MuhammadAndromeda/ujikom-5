<?php

namespace App\Filament\Resources\Sales\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer')->label("Customer Name"),
                SelectColumn::make('material')->options([
                    'pasir_halus' => 'Pasir Halus',
                    'sirtu' => 'Sirtu',
                    'kerikil_kotor' => 'Kerikil Kotor',
                    'kerikil_bersih' => 'Kerikil Bersih',
                    'pasir_sungai' => 'Pasir Sungai',
                ])->label('Material Name'),
                TextColumn::make('quantity')->label("(QTY/M3)")->suffix(' M3')->alignCenter(),
                TextColumn::make('rit')->label("(Rit)")->alignCenter(),
                TextColumn::make('price')->label('Price')->money('idr', true),
                SelectColumn::make('payment_status')->options([
                    'unpaid' => 'Unpaid',
                    'cash' => 'Cash',
                    'transfer' => 'Transfer',
                    'debt' => 'Debt',
                ]),
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
