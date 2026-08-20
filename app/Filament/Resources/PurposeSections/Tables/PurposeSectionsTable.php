<?php

namespace App\Filament\Resources\PurposeSections\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PurposeSectionsTable
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
                    ->width(90),

                TextColumn::make('experience_value')
                    ->label('Experience')
                    ->placeholder('Not provided'),

                TextColumn::make('experience_label')
                    ->label('Experience Label')
                    ->placeholder('Not provided'),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}