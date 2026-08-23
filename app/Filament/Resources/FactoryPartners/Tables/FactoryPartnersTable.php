<?php

namespace App\Filament\Resources\FactoryPartners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FactoryPartnersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('name')
                    ->label('Factory')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('specialization')
                    ->limit(45)
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('compliance')
                    ->label('Compliant')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('leed')
                    ->label('LEED')
                    ->badge()
                    ->placeholder('Not provided')
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('Monthly Capacity')
                    ->placeholder('Not provided'),

                IconColumn::make('profile')
                    ->label('PDF')
                    ->boolean(
                        fn ($state): bool => filled($state)
                    ),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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