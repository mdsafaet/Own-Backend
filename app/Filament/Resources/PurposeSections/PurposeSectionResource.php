<?php

namespace App\Filament\Resources\PurposeSections;

use App\Filament\Resources\PurposeSections\Pages\CreatePurposeSection;
use App\Filament\Resources\PurposeSections\Pages\EditPurposeSection;
use App\Filament\Resources\PurposeSections\Pages\ListPurposeSections;
use App\Filament\Resources\PurposeSections\Schemas\PurposeSectionForm;
use App\Filament\Resources\PurposeSections\Tables\PurposeSectionsTable;
use App\Models\PurposeSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PurposeSectionResource extends Resource
{
    protected static ?string $model =
        PurposeSection::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup =
        'Home';

    protected static ?string $navigationLabel =
        'Purpose Image';

    protected static ?string $modelLabel =
        'Purpose Section';

    protected static ?string $pluralModelLabel =
        'Purpose Section';

    protected static ?int $navigationSort = 2;

    public static function form(
        Schema $schema
    ): Schema {
        return PurposeSectionForm::configure($schema);
    }

    public static function table(
        Table $table
    ): Table {
        return PurposeSectionsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return ! PurposeSection::query()->exists();
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListPurposeSections::route('/'),

            'create' =>
                CreatePurposeSection::route('/create'),

            'edit' =>
                EditPurposeSection::route(
                    '/{record}/edit'
                ),
        ];
    }
}