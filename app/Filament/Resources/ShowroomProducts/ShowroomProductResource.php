<?php

namespace App\Filament\Resources\ShowroomProducts;

use App\Filament\Resources\ShowroomProducts\Pages\CreateShowroomProduct;
use App\Filament\Resources\ShowroomProducts\Pages\EditShowroomProduct;
use App\Filament\Resources\ShowroomProducts\Pages\ListShowroomProducts;
use App\Filament\Resources\ShowroomProducts\Schemas\ShowroomProductForm;
use App\Filament\Resources\ShowroomProducts\Tables\ShowroomProductsTable;
use App\Models\ShowroomProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ShowroomProductResource extends Resource
{
    protected static ?string $model =
        ShowroomProduct::class;

    protected static string|BackedEnum|null
        $navigationIcon =
            Heroicon::OutlinedShoppingBag;

    protected static string|UnitEnum|null
        $navigationGroup =
            'Innovation Hub';

    protected static ?string $navigationLabel =
        'Product Showroom';

    protected static ?string $modelLabel =
        'Showroom Product';

    protected static ?string $pluralModelLabel =
        'Showroom Products';

    protected static ?int $navigationSort = 1;

    public static function form(
        Schema $schema
    ): Schema {
        return ShowroomProductForm::configure(
            $schema
        );
    }

    public static function table(
        Table $table
    ): Table {
        return ShowroomProductsTable::configure(
            $table
        );
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListShowroomProducts::route('/'),

            'create' =>
                CreateShowroomProduct::route(
                    '/create'
                ),

            'edit' =>
                EditShowroomProduct::route(
                    '/{record}/edit'
                ),
        ];
    }
}