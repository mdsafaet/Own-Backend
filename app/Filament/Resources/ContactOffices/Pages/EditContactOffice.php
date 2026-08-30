<?php

namespace App\Filament\Resources\ContactOffices\Pages;

use App\Filament\Resources\ContactOffices\ContactOfficeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactOffice extends EditRecord
{
    protected static string $resource = ContactOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
