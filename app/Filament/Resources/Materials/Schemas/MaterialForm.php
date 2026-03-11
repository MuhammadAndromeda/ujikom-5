<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Material')
                    ->required(),
                TextInput::make('unit')
                    ->label('Satuan')
                    ->required()
                    ->default('M³'),
                TextInput::make('stock')
                    ->label('Stock (M³)')
                    ->numeric()
                    ->default(0)
                    ->prefix('M³'),
            ]);
    }
}