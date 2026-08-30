<?php

namespace App\Filament\Resources\FooterSettings\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FooterSettingsTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->columns([
                TextColumn::make(
                    'brand_title'
                )
                    ->label('Company')
                    ->searchable()
                    ->weight('bold')
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make(
                    'office_title'
                )
                    ->label('Office')
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make('email')
                    ->label('Email')
                    ->placeholder(
                        'Not provided'
                    ),

                IconColumn::make(
                    'is_active'
                )
                    ->label('Active')
                    ->boolean(),

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