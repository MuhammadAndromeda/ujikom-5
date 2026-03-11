<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Customer')
                    ->required(),
                TextInput::make('phone')
                    ->label('No. Telepon')
                    ->tel()
                    ->default(null),
                TextInput::make('address')
                    ->label('Alamat')
                    ->default(null),
            ]);
    }
}
