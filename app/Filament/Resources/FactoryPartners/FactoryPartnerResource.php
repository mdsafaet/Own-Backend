<?php

namespace App\Filament\Resources\FactoryPartners;

use App\Filament\Resources\FactoryPartners\Pages\CreateFactoryPartner;
use App\Filament\Resources\FactoryPartners\Pages\EditFactoryPartner;
use App\Filament\Resources\FactoryPartners\Pages\ListFactoryPartners;
use App\Filament\Resources\FactoryPartners\Schemas\FactoryPartnerForm;
use App\Filament\Resources\FactoryPartners\Tables\FactoryPartnersTable;
use App\Models\FactoryPartner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FactoryPartnerResource extends Resource
{
    protected static ?string $model = FactoryPartner::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedBuildingOffice2;

    protected static string|UnitEnum|null $navigationGroup =
        'Factory Directory';

    protected static ?string $navigationLabel =
        'Factory Partners';

    protected static ?string $modelLabel =
        'Factory Partner';

    protected static ?string $pluralModelLabel =
        'Factory Partners';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return FactoryPartnerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FactoryPartnersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFactoryPartners::route('/'),
            'create' => CreateFactoryPartner::route('/create'),
            'edit' => EditFactoryPartner::route('/{record}/edit'),
        ];
    }
}