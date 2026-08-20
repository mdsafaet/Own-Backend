<?php

namespace App\Filament\Resources\Jobs;

use App\Filament\Resources\Jobs\Pages\CreateJob;
use App\Filament\Resources\Jobs\Pages\EditJob;
use App\Filament\Resources\Jobs\Pages\ListJobs;
use App\Filament\Resources\Jobs\RelationManagers\ApplicationsRelationManager;
use App\Filament\Resources\Jobs\Schemas\JobForm;
use App\Filament\Resources\Jobs\Tables\JobsTable;
use App\Models\Job;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JobResource extends Resource
{
    protected static ?string $model =
        Job::class;

    protected static string|BackedEnum|null
        $navigationIcon =
            Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null
        $navigationGroup = 'Careers';

    protected static ?string
        $navigationLabel = 'Vacancies';

    protected static ?string
        $modelLabel = 'Vacancy';

    protected static ?string
        $pluralModelLabel = 'Vacancies';

    protected static ?int
        $navigationSort = 1;

    public static function form(
        Schema $schema
    ): Schema {
        return JobForm::configure($schema);
    }

    public static function table(
        Table $table
    ): Table {
        return JobsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ApplicationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListJobs::route('/'),

            'create' =>
                CreateJob::route('/create'),

            'edit' =>
                EditJob::route(
                    '/{record}/edit'
                ),
        ];
    }
}