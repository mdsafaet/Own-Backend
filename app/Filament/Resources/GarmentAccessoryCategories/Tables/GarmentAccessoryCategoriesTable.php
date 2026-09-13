<?php

namespace App\Filament\Resources\GarmentAccessoryCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GarmentAccessoryCategoriesTable
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
                    ->height(60)
                    ->width(90),

                TextColumn::make('title')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('icon')
                    ->label('Icon')
                    ->badge()
                    ->placeholder(
                        'Default icon'
                    )
                    ->toggleable(),

                TextColumn::make(
                    'description'
                )
                    ->label('Description')
                    ->limit(50)
                    ->wrap()
                    ->placeholder(
                        'Not provided'
                    )
                    ->toggleable(),

                TextColumn::make('products')
                    ->label('Products')
                    ->formatStateUsing(
                        function (
                            mixed $state
                        ): string {
                            if (
                                is_array($state)
                            ) {
                                return implode(
                                    ', ',
                                    $state
                                );
                            }

                            return $state ?: 'No products';
                        }
                    )
                    ->limit(60)
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
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