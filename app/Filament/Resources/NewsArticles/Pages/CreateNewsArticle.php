<?php

namespace App\Filament\Resources\NewsArticles\Pages;

use App\Filament\Resources\NewsArticles\NewsArticleResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateNewsArticle extends CreateRecord
{
    protected static string $resource =
        NewsArticleResource::class;

    protected function onValidationError(
        ValidationException $exception
    ): void {
        Notification::make()
            ->title(
                'Required information is missing'
            )
            ->body(
                'Please fill in the highlighted required fields and try again.'
            )
            ->danger()
            ->persistent()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl(
            'edit',
            [
                'record' => $this->record,
            ]
        );
    }
}