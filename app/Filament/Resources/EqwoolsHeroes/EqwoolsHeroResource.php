<?php

namespace App\Filament\Resources\GarmentAccessoryCategories;

use App\Filament\Resources\GarmentAccessoryCategories\Pages\CreateGarmentAccessoryCategory;
use App\Filament\Resources\GarmentAccessoryCategories\Pages\EditGarmentAccessoryCategory;
use App\Filament\Resources\GarmentAccessoryCategories\Pages\ListGarmentAccessoryCategories;
use App\Filament\Resources\GarmentAccessoryCategories\Schemas\GarmentAccessoryCategoryForm;
use App\Filament\Resources\GarmentAccessoryCategories\Tables\GarmentAccessoryCategoriesTable;
use App\Models\GarmentAccessoryCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GarmentAccessoryCategoryResource extends Resource
{
    protected static ?string $model =
        GarmentAccessoryCategory::class;

    protected static string|BackedEnum|null
        $navigationIcon =
            Heroicon::OutlinedTag;

    protected static string|UnitEnum|null
        $navigationGroup =
            'Garment Accessories';

    protected static ?string
        $navigationLabel =
            'Accessory Categories';

    protected static ?string
        $modelLabel =
            'Accessory Category';

    protected static ?string
        $pluralModelLabel =
            'Accessory Categories';

    protected static ?int
        $navigationSort = 1;

    public static function form(
        Schema $schema
    ): Schema {
        return GarmentAccessoryCategoryForm::configure(
            $schema
        );
    }

    public static function table(
        Table $table
    ): Table {
        return GarmentAccessoryCategoriesTable::configure(
            $table
        );
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListGarmentAccessoryCategories::route(
                    '/'
                ),

            'create' =>
                CreateGarmentAccessoryCategory::route(
                    '/create'
                ),

            'edit' =>
                EditGarmentAccessoryCategory::route(
                    '/{record}/edit'
                ),
        ];
    }
}