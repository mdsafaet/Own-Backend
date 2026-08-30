<?php

namespace App\Filament\Resources\GarmentAccessoryCategories\Pages;

use App\Filament\Resources\GarmentAccessoryCategories\GarmentAccessoryCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGarmentAccessoryCategory extends EditRecord
{
    protected static string $resource = GarmentAccessoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
