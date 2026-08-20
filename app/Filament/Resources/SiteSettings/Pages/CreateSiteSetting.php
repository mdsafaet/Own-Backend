<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use App\Models\SiteSetting;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteSetting extends CreateRecord
{
    protected static string $resource =
        SiteSettingResource::class;

    public function mount(): void
    {
        $existingSettings =
            SiteSetting::query()->first();

        if ($existingSettings) {
            $this->redirect(
                SiteSettingResource::getUrl(
                    'edit',
                    [
                        'record' => $existingSettings,
                    ],
                ),
            );

            return;
        }

        parent::mount();
    }

    protected function getRedirectUrl(): string
    {
        return SiteSettingResource::getUrl('index');
    }
}