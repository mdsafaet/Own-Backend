<?php

namespace App\Filament\Resources\NewsArticles\Pages;

use App\Filament\Resources\NewsArticles\NewsArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditNewsArticle extends EditRecord
{
    protected static string $resource =
        NewsArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Delete Article'),
        ];
    }

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
        return static::getResource()::getUrl();
    }
}