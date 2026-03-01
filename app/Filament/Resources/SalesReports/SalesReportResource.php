<?php

namespace App\Filament\Resources\SalesReports;

// use App\Filament\Resources\SalesReports\Pages\CreateSalesReport;
// use App\Filament\Resources\SalesReports\Pages\EditSalesReport;
use App\Filament\Resources\SalesReports\Pages\ListSalesReports;
use App\Filament\Resources\SalesReports\Schemas\SalesReportForm;
use App\Filament\Resources\SalesReports\Tables\SalesReportsTable;
use App\Models\Sales;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SalesReportResource extends Resource
{
    protected static ?string $model = Sales::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Sales Report';

    protected static ?string $modelLabel = 'Sales Report';
    
    protected static ?string $pluralModelLabel = 'Sales Report';
    
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return SalesReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalesReports::route('/'),
        ];
    }
}
