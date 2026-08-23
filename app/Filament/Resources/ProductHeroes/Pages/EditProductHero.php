<?php

namespace App\Filament\Resources\ProductHeroes\Pages;

use App\Filament\Resources\ProductHeroes\ProductHeroResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductHero extends EditRecord
{
    protected static string $resource = ProductHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
