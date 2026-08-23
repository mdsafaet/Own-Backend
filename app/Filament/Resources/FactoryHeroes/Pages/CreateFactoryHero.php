<?php

namespace App\Filament\Resources\FactoryHeroes\Pages;

use App\Filament\Resources\FactoryHeroes\FactoryHeroResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFactoryHero extends CreateRecord
{
    protected static string $resource = FactoryHeroResource::class;
}
