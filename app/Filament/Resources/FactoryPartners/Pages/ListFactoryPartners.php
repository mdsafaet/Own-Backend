<?php

namespace App\Filament\Resources\FactoryPartners\Pages;

use App\Filament\Resources\FactoryPartners\FactoryPartnerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFactoryPartners extends ListRecords
{
    protected static string $resource = FactoryPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
