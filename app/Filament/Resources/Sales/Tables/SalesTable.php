<?php

namespace App\Filament\Resources\Sales\Tables;

// use Dom\Text;

use App\Models\Material;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
// use Filament\Tables\Columns\SelectColumn;
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
                    ->label("Nama Customer"),
                TextColumn::make('material')
                    ->badge()
                    ->color('gray')
                    ->label('Nama Material'),
                TextColumn::make('quantity')
                    ->label("(QTY/M³)")
                    ->suffix(' M³')
                    ->alignCenter(),
                TextColumn::make('rit')
                    ->label("(Rit)")
                    ->alignCenter(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr', true),
                TextColumn::make('paid')
                    ->label('Dibayar')
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
                TextColumn::make('created_at')
                    ->label('Tanggal Penjualan')
                    ->date('d M Y')
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
