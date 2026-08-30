<?php

namespace App\Filament\Resources\ContactOffices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactOfficesTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make(
                    'country'
                )
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('title')
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make(
                    'company'
                )
                    ->placeholder(
                        'Not provided'
                    )
                    ->toggleable(),

                TextColumn::make('email')
                    ->searchable()
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make('phone')
                    ->placeholder(
                        'Not provided'
                    )
                    ->toggleable(),

                IconColumn::make(
                    'featured'
                )
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                IconColumn::make(
                    'is_active'
                )
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make(
                    'sort_order'
                )
                    ->label('Order')
                    ->sortable(),

                TextColumn::make(
                    'updated_at'
                )
                    ->label('Updated')
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