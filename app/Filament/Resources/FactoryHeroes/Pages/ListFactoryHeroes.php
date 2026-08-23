<?php

namespace App\Filament\Resources\FactoryHeroes\Pages;

use App\Filament\Resources\FactoryHeroes\FactoryHeroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFactoryHeroes extends ListRecords
{
    protected static string $resource = FactoryHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
