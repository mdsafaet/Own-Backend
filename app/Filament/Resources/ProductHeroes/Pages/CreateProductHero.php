<?php

namespace App\Filament\Resources\ProductHeroes\Pages;

use App\Filament\Resources\ProductHeroes\ProductHeroResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductHero extends CreateRecord
{
    protected static string $resource = ProductHeroResource::class;
}
