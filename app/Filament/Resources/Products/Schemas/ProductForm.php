<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('name')->options([
                    'pasir_halus' => 'Pasir Halus',
                    'sirtu' => 'Sirtu',
                    'kerikil_kotor' => 'Kerikil Kotor',
                    'kerikil_bersih' => 'Kerikil Bersih',
                    'pasir_sungai' => 'Pasir Sungai',
                ])->label('Material Name'),

                TextInput::make('price')->label('Material Price')->numeric()->prefix('Rp'),

                Select::make('payment_status')->options([
                    'unpaid' => 'Unpaid',
                    'cash' => 'Cash',
                    'transfer' => 'Transfer',
                    'debt' => 'Debt',
                ])->label('Payment Status'),
            ]);
    }
}
