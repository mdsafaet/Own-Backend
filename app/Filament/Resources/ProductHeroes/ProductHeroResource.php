<?php

namespace App\Filament\Resources\ProductHeroes;

use App\Filament\Resources\ProductHeroes\Pages\CreateProductHero;
use App\Filament\Resources\ProductHeroes\Pages\EditProductHero;
use App\Filament\Resources\ProductHeroes\Pages\ListProductHeroes;
use App\Filament\Resources\ProductHeroes\Schemas\ProductHeroForm;
use App\Filament\Resources\ProductHeroes\Tables\ProductHeroesTable;
use App\Models\ProductHero;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProductHeroResource extends Resource
{
    protected static ?string $model = ProductHero::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = 'Products';

    protected static ?string $navigationLabel = 'Product Hero';

    protected static ?string $modelLabel = 'Product Hero';

    protected static ?string $pluralModelLabel = 'Product Hero';

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return ProductHeroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductHeroesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductHeroes::route('/'),
            'create' => CreateProductHero::route('/create'),
            'edit' => EditProductHero::route('/{record}/edit'),
        ];
    }
}