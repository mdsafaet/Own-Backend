<?php

namespace App\Filament\Resources\BusinessHours;

use App\Filament\Resources\BusinessHours\Pages\CreateBusinessHour;
use App\Filament\Resources\BusinessHours\Pages\EditBusinessHour;
use App\Filament\Resources\BusinessHours\Pages\ListBusinessHours;
use App\Filament\Resources\BusinessHours\Schemas\BusinessHourForm;
use App\Filament\Resources\BusinessHours\Tables\BusinessHoursTable;
use App\Models\BusinessHour;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BusinessHourResource extends Resource
{
    protected static ?string $model = BusinessHour::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedClock;

    protected static string|UnitEnum|null $navigationGroup =
        'Contact Page';

    protected static ?string $navigationLabel =
        'Business Hours';

    protected static ?string $modelLabel =
        'Business Hours';

    protected static ?string $pluralModelLabel =
        'Business Hours';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return BusinessHourForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BusinessHoursTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return ! BusinessHour::query()->exists();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessHours::route('/'),
            'create' => CreateBusinessHour::route('/create'),
            'edit' => EditBusinessHour::route('/{record}/edit'),
        ];
    }
}