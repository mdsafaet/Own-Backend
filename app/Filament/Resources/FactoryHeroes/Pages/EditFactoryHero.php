<?php

namespace App\Filament\Resources\FactoryHeroes\Pages;

use App\Filament\Resources\FactoryHeroes\FactoryHeroResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFactoryHero extends EditRecord
{
    protected static string $resource = FactoryHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
