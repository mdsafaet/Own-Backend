<?php

namespace App\Filament\Resources\NewsArticles\Tables;

use App\Models\NewsArticle;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsArticlesTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->height(42)
                    ->width(64)
                    ->extraImgAttributes([
                        'class' =>
                            'rounded-lg object-cover',
                    ]),

                TextColumn::make('title')
                    ->label('Article')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(55),

                TextColumn::make('content_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(
                        fn (
                            string $state
                        ): string =>
                            $state === 'external'
                                ? 'External Link'
                                : 'Internal Article'
                    )
                    ->color(
                        fn (
                            string $state
                        ): string =>
                            $state === 'external'
                                ? 'warning'
                                : 'info'
                    ),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->placeholder(
                        'Uncategorized'
                    ),

                TextColumn::make('source_name')
                    ->label('Source')
                    ->placeholder(
                        'Own Website'
                    )
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(
                        fn (
                            string $state
                        ): string =>
                            $state === 'published'
                                ? 'success'
                                : 'gray'
                    ),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime(
                        'd M Y, h:i A'
                    )
                    ->placeholder(
                        'Not scheduled'
                    )
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime(
                        'd M Y, h:i A'
                    )
                    ->sortable()
                    ->toggleable(
                        isToggledHiddenByDefault: true
                    ),
            ])
            ->defaultSort(
                'published_at',
                'desc'
            )
            ->recordActions([
                Action::make('openExternal')
                    ->label('Open Link')
                    ->icon(
                        'heroicon-o-arrow-top-right-on-square'
                    )
                    ->url(
                        fn (
                            NewsArticle $record
                        ): ?string =>
                            $record->external_url
                    )
                    ->openUrlInNewTab()
                    ->visible(
                        fn (
                            NewsArticle $record
                        ): bool =>
                            $record->content_type
                                === 'external'
                            && filled(
                                $record->external_url
                            )
                    ),

                Action::make('publish')
                    ->label('Publish')
                    ->icon(
                        'heroicon-o-check-circle'
                    )
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(
                        fn (
                            NewsArticle $record
                        ): bool =>
                            $record->status
                                !== 'published'
                    )
                    ->action(function (
                        NewsArticle $record
                    ): void {
                        $record->update([
                            'status' =>
                                'published',

                            'published_at' =>
                                $record->published_at
                                ?? now(),
                        ]);

                        Notification::make()
                            ->title(
                                'Article published'
                            )
                            ->success()
                            ->send();
                    }),

                Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon(
                        'heroicon-o-eye-slash'
                    )
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(
                        fn (
                            NewsArticle $record
                        ): bool =>
                            $record->status
                                === 'published'
                    )
                    ->action(function (
                        NewsArticle $record
                    ): void {
                        $record->update([
                            'status' => 'draft',
                        ]);

                        Notification::make()
                            ->title(
                                'Article moved to draft'
                            )
                            ->success()
                            ->send();
                    }),

                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}