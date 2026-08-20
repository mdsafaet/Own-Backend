<?php

namespace App\Filament\Resources\HeroSlides\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HeroSlidesTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->height(60)
                    ->width(100),

                TextColumn::make('title')
                    ->label('Title')
                    ->placeholder('No title')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('highlighted_title')
                    ->label('Highlighted Title')
                    ->placeholder('Not provided')
                    ->limit(40),

                TextColumn::make('position')
                    ->label('Position')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string =>
                            ucfirst($state)
                    ),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}