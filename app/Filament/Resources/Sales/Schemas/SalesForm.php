<?php

namespace App\Filament\Resources\Sales\Schemas;

use App\Models\Material;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SalesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer')
                    ->label("Nama Customer"),

                Select::make('material')
                    ->label('Nama Material')
                    ->options(Material::whereNotNull('name')->where('name', '!=', '')->pluck('name', 'name')->toArray())
                    ->required(),

                TextInput::make('quantity')
                    ->label("Quantity Penjualan (QTY/M³)")
                    ->numeric()
                    ->prefix('M³')
                    ->required(),

                TextInput::make('rit')
                    ->label("Rencana Perjalanan (Rit)")
                    ->numeric()
                    ->required(),

                TextInput::make('price')
                    ->label('Harga Material')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('paid')
                    ->label('Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Select::make('payment_status')->options([
                    'unpaid' => 'Unpaid',
                    'cash' => 'Cash',
                    'transfer' => 'Transfer',
                    'debt' => 'Debt',
                ])->label('Payment Status')->required(),
            ]);
    }
}
