<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([])->paginated(false)->emptyStateHeading('')->emptyStateDescription('')->emptyStateIcon(null);
    }
}
