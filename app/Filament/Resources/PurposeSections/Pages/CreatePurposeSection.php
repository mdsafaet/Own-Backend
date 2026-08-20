<?php

namespace App\Filament\Resources\PurposeSections\Pages;

use App\Filament\Resources\PurposeSections\PurposeSectionResource;
use App\Models\PurposeSection;
use Filament\Resources\Pages\CreateRecord;

class CreatePurposeSection extends CreateRecord
{
    protected static string $resource =
        PurposeSectionResource::class;

    public function mount(): void
    {
        $existingRecord =
            PurposeSection::query()->first();

        if ($existingRecord) {
            $this->redirect(
                PurposeSectionResource::getUrl(
                    'edit',
                    [
                        'record' => $existingRecord,
                    ],
                ),
            );

            return;
        }

        parent::mount();
    }

    protected function getRedirectUrl(): string
    {
        return PurposeSectionResource::getUrl(
            'index'
        );
    }
}