<?php

namespace App\Filament\Resources\Sales\Schemas;

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
                TextInput::make('customer')->label("Customer Name"),
                
                DatePicker::make('sales_date')->label('Sales Date'),

                Select::make('material')->options([
                    'pasir_halus' => 'Pasir Halus',
                    'sirtu' => 'Sirtu',
                    'kerikil_kotor' => 'Kerikil Kotor',
                    'kerikil_bersih' => 'Kerikil Bersih',
                    'pasir_sungai' => 'Pasir Sungai',
                ])->label('Material Name')->required(),

                TextInput::make('quantity')->label("Sales Quantity (QTY/M3)")->numeric()->prefix('M3')->required(),

                TextInput::make('rit')->label("Travel Itinerary (Rit)")->numeric()->required(),

                TextInput::make('price')->label('Material Price')->numeric()->prefix('Rp')->required(),

                Select::make('payment_status')->options([
                    'unpaid' => 'Unpaid',
                    'cash' => 'Cash',
                    'transfer' => 'Transfer',
                    'debt' => 'Debt',
                ])->label('Payment Status')->required(),
            ]);
    }
}
