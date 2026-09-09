<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(
                        asset('images/profile-placeholder.png')
                    ),

                TextColumn::make('name')
                    ->label('Reviewer')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('company')
                    ->searchable()
                    ->placeholder('Not provided')
                    ->toggleable(),

                TextColumn::make('designation')
                    ->placeholder('Not provided')
                    ->toggleable(),

                TextColumn::make('feedback')
                    ->label('Feedback')
                    ->limit(60)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(
                        fn ($state): string =>
                            str_repeat('★', (int) $state)
                    )
                    ->color('warning')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable()
                    ->toggleable(
                        isToggledHiddenByDefault: true
                    ),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}