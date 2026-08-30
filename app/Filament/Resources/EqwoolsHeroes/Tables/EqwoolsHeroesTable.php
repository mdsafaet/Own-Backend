<?php

namespace App\Filament\Resources\EqwoolsHeroes\Tables;

use Filament\Actions\DeleteAction;
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
            ->columns([
                ImageColumn::make(
                    'background_image'
                )
                    ->label('Image')
                    ->disk('public')
                    ->visibility('public')
                    ->square(),

                TextColumn::make('eyebrow')
                    ->label('Small Heading')
                    ->searchable()
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make('title')
                    ->label('Main Title')
                    ->searchable()
                    ->weight('bold')
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make(
                    'highlighted_title'
                )
                    ->label(
                        'Highlighted Title'
                    )
                    ->placeholder(
                        'Not provided'
                    ),

                IconColumn::make(
                    'is_active'
                )
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make(
                    'updated_at'
                )
                    ->label('Updated')
                    ->dateTime(
                        'd M Y, h:i A'
                    )
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}