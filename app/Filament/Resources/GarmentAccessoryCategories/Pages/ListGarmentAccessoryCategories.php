<?php

namespace App\Filament\Resources\GarmentAccessoryCategories\Pages;

use App\Filament\Resources\GarmentAccessoryCategories\GarmentAccessoryCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGarmentAccessoryCategories extends ListRecords
{
    protected static string $resource = GarmentAccessoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
