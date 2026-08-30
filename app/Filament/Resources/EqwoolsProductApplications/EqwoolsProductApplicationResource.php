<?php

namespace App\Filament\Resources\EqwoolsProductApplications;

use App\Filament\Resources\EqwoolsProductApplications\Pages\CreateEqwoolsProductApplication;
use App\Filament\Resources\EqwoolsProductApplications\Pages\EditEqwoolsProductApplication;
use App\Filament\Resources\EqwoolsProductApplications\Pages\ListEqwoolsProductApplications;
use App\Filament\Resources\EqwoolsProductApplications\Schemas\EqwoolsProductApplicationForm;
use App\Filament\Resources\EqwoolsProductApplications\Tables\EqwoolsProductApplicationsTable;
use App\Models\EqwoolsProductApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EqwoolsProductApplicationResource extends Resource
{
    protected static ?string $model =
        EqwoolsProductApplication::class;

    protected static string|BackedEnum|null
        $navigationIcon =
            Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null
        $navigationGroup =
            'EQWOOLS';

    protected static ?string
        $navigationLabel =
            'Product Applications';

    protected static ?string
        $modelLabel =
            'Product Application';

    protected static ?string
        $pluralModelLabel =
            'Product Applications';

    protected static ?int
        $navigationSort = 1;

    public static function form(
        Schema $schema
    ): Schema {
        return EqwoolsProductApplicationForm::configure(
            $schema
        );
    }

    public static function table(
        Table $table
    ): Table {
        return EqwoolsProductApplicationsTable::configure(
            $table
        );
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListEqwoolsProductApplications::route(
                    '/'
                ),

            'create' =>
                CreateEqwoolsProductApplication::route(
                    '/create'
                ),

            'edit' =>
                EditEqwoolsProductApplication::route(
                    '/{record}/edit'
                ),
        ];
    }
}