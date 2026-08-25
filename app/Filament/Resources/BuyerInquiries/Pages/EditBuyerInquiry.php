<?php

namespace App\Filament\Resources\BuyerInquiries\Pages;

use App\Filament\Resources\BuyerInquiries\BuyerInquiryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBuyerInquiry extends EditRecord
{
    protected static string $resource =
        BuyerInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(
        array $data
    ): array {
        if (
            ($data['status'] ?? null) === 'contacted' &&
            blank($this->record->contacted_at)
        ) {
            $data['contacted_at'] = now();
        }

        return $data;
    }
}