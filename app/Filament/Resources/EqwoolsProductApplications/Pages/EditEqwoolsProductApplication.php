<?php

namespace App\Filament\Resources\EqwoolsProductApplications\Pages;

use App\Filament\Resources\EqwoolsProductApplications\EqwoolsProductApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEqwoolsProductApplication extends EditRecord
{
    protected static string $resource = EqwoolsProductApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
