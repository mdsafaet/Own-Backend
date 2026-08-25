<?php

namespace App\Filament\Resources\ShowroomProducts\Pages;

use App\Filament\Resources\ShowroomProducts\ShowroomProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShowroomProduct extends EditRecord
{
    protected static string $resource =
        ShowroomProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}