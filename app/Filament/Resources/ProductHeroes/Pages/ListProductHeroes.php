<?php

namespace App\Filament\Resources\ProductHeroes\Pages;

use App\Filament\Resources\ProductHeroes\ProductHeroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductHeroes extends ListRecords
{
    protected static string $resource = ProductHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
