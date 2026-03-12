<?php

namespace App\Filament\Resources\Users\Schemas;

// use Filament\Forms\Components\DateTimePicker;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->hint('Kosongkan jika tidak ingin mengubah password'),
                Toggle::make('is_admin')
                    ->label('Admin')
                    ->required(),
                Toggle::make('can_access')
                    ->label('Akses Dashboard')
                    ->required(),
                CheckboxList::make('permissions')
                    ->label('Akses Menu')
                    ->options(Permission::all()->pluck('name', 'name')->toArray())
                    ->columns(2)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record) {
                            $component->state($record->permissions->pluck('name')->toArray());
                        }
                    })
                    ->saveRelationshipsUsing(function ($record, $state) {
                        $permissions = $state ?? [];
                        
                        if (!in_array('view dashboard', $permissions)) {
                            $permissions[] = 'view dashboard';
                        }
                        
                        $record->syncPermissions($permissions);
                    }),
            ]);
    }
}
