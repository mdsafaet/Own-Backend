<?php

namespace App\Filament\Resources\FactoryHeroes;

use App\Filament\Resources\FactoryHeroes\Pages\CreateFactoryHero;
use App\Filament\Resources\FactoryHeroes\Pages\EditFactoryHero;
use App\Filament\Resources\FactoryHeroes\Pages\ListFactoryHeroes;
use App\Filament\Resources\FactoryHeroes\Schemas\FactoryHeroForm;
use App\Filament\Resources\FactoryHeroes\Tables\FactoryHeroesTable;
use App\Models\FactoryHero;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FactoryHeroResource extends Resource
{
    protected static ?string $model = FactoryHero::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup =
        'Factory Directory';

    protected static ?string $navigationLabel =
        'Factory Hero';

    protected static ?string $modelLabel =
        'Factory Hero';

    protected static ?string $pluralModelLabel =
        'Factory Hero';

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return FactoryHeroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FactoryHeroesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFactoryHeroes::route('/'),
            'create' => CreateFactoryHero::route('/create'),
            'edit' => EditFactoryHero::route('/{record}/edit'),
        ];
    }
}