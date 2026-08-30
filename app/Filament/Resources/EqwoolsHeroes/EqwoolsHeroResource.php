<?php

namespace App\Filament\Resources\EqwoolsHeroes;

use App\Filament\Resources\EqwoolsHeroes\Pages\CreateEqwoolsHero;
use App\Filament\Resources\EqwoolsHeroes\Pages\EditEqwoolsHero;
use App\Filament\Resources\EqwoolsHeroes\Pages\ListEqwoolsHeroes;
use App\Filament\Resources\EqwoolsHeroes\Schemas\EqwoolsHeroForm;
use App\Filament\Resources\EqwoolsHeroes\Tables\EqwoolsHeroesTable;
use App\Models\EqwoolsHero;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EqwoolsHeroResource extends Resource
{
    protected static ?string $model =
        EqwoolsHero::class;

    protected static string|BackedEnum|null
        $navigationIcon =
            Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null
        $navigationGroup =
            'EQWOOLS';

    protected static ?string
        $navigationLabel =
            'Hero Section';

    protected static ?string
        $modelLabel =
            'EQWOOLS Hero';

    protected static ?string
        $pluralModelLabel =
            'EQWOOLS Hero';

    protected static ?int
        $navigationSort = 0;

    public static function form(
        Schema $schema
    ): Schema {
        return EqwoolsHeroForm::configure(
            $schema
        );
    }

    public static function table(
        Table $table
    ): Table {
        return EqwoolsHeroesTable::configure(
            $table
        );
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListEqwoolsHeroes::route(
                    '/'
                ),

            'create' =>
                CreateEqwoolsHero::route(
                    '/create'
                ),

            'edit' =>
                EditEqwoolsHero::route(
                    '/{record}/edit'
                ),
        ];
    }
}