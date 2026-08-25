<?php

namespace App\Filament\Resources\ShowroomProducts\Pages;

use App\Filament\Resources\ShowroomProducts\ShowroomProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShowroomProducts extends ListRecords
{
    protected static string $resource =
        ShowroomProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Showroom Product'),
        ];
    }
}