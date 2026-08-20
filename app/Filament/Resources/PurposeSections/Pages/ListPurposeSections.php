<?php

namespace App\Filament\Resources\PurposeSections\Pages;

use App\Filament\Resources\PurposeSections\PurposeSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPurposeSections extends ListRecords
{
    protected static string $resource =
        PurposeSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create Purpose Image')
                ->visible(
                    fn (): bool =>
                        PurposeSectionResource::canCreate()
                ),
        ];
    }
}