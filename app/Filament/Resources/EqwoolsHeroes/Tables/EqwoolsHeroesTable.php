<?php

namespace App\Filament\Resources\EqwoolsHeroes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EqwoolsHeroesTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->defaultSort(
                'updated_at',
                'desc'
            )
            ->columns([
                ImageColumn::make(
                    'background_image'
                )
                    ->label('Hero Image')
                    ->disk('public')
                    ->height(60)
                    ->width(100),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(40)
                    ->placeholder(
                        'No title'
                    ),

                TextColumn::make(
                    'highlighted_title'
                )
                    ->label(
                        'Highlighted Title'
                    )
                    ->limit(40)
                    ->placeholder(
                        'Not provided'
                    )
                    ->toggleable(),

                TextColumn::make('eyebrow')
                    ->label('Eyebrow')
                    ->limit(30)
                    ->placeholder(
                        'Not provided'
                    )
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime(
                        'd M Y, h:i A'
                    )
                    ->sortable()
                    ->toggleable(
                        isToggledHiddenByDefault:
                            true
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