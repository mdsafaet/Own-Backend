<?php

namespace App\Filament\Resources\EqwoolsProductApplications\Pages;

use App\Filament\Resources\EqwoolsProductApplications\EqwoolsProductApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEqwoolsProductApplications extends ListRecords
{
    protected static string $resource = EqwoolsProductApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
