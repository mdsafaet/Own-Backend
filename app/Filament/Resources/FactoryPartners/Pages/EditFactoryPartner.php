<?php

namespace App\Filament\Resources\FactoryPartners\Pages;

use App\Filament\Resources\FactoryPartners\FactoryPartnerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFactoryPartner extends EditRecord
{
    protected static string $resource = FactoryPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
