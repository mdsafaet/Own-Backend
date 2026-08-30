<?php

namespace App\Filament\Resources\BusinessHours\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusinessHoursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('working_days')
                    ->label('Working Days')
                    ->placeholder('Not provided')
                    ->searchable(),

                TextColumn::make('working_hours')
                    ->label('Working Hours')
                    ->placeholder('Not provided'),

                TextColumn::make('timezone')
                    ->label('Timezone')
                    ->placeholder('Not provided'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->placeholder('Not provided'),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}