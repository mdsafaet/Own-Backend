<?php

namespace App\Filament\Resources\PurposeSections\Pages;

use App\Filament\Resources\PurposeSections\PurposeSectionResource;
use Filament\Resources\Pages\EditRecord;

class EditPurposeSection extends EditRecord
{
    protected static string $resource =
        PurposeSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return PurposeSectionResource::getUrl(
            'index'
        );
    }
}