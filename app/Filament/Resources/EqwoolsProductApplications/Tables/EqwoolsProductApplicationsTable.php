<?php

namespace App\Filament\Resources\EqwoolsProductApplications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EqwoolsProductApplicationsTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make(
                    'description'
                )
                    ->limit(50)
                    ->placeholder(
                        'No description'
                    )
                    ->toggleable(),

                TextColumn::make(
                    'products'
                )
                    ->label('Products')
                    ->badge()
                    ->separator(',')
                    ->limitList(3)
                    ->expandableLimitedList(),

                TextColumn::make(
                    'fabrics'
                )
                    ->label('Fabrics')
                    ->badge()
                    ->separator(',')
                    ->limitList(3)
                    ->expandableLimitedList(),

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