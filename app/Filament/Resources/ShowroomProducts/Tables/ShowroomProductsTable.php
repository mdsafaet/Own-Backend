<?php

namespace App\Filament\Resources\ShowroomProducts\Tables;

use App\Models\ShowroomProduct;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ShowroomProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('title')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('product_code')
                    ->label('Code')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (?string $state): string =>
                            match ($state) {
                                'new_arrival' =>
                                    'New Arrival',

                                'ready_for_sampling' =>
                                    'Ready for Sampling',

                                'in_development' =>
                                    'In Development',

                                default =>
                                    $state ?: 'Not Set',
                            }
                    )
                    ->color(
                        fn (?string $state): string =>
                            match ($state) {
                                'new_arrival' =>
                                    'success',

                                'ready_for_sampling' =>
                                    'info',

                                'in_development' =>
                                    'warning',

                                default => 'gray',
                            }
                    ),

                TextColumn::make('moq')
                    ->label('MOQ')
                    ->placeholder('Not specified')
                    ->toggleable(),

                IconColumn::make('sustainable')
                    ->label('Sustainable')
                    ->boolean(),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Product Category')
                    ->options(
                        fn (): array =>
                            ShowroomProduct::query()
                                ->whereNotNull('category')
                                ->where('category', '!=', '')
                                ->distinct()
                                ->orderBy('category')
                                ->pluck(
                                    'category',
                                    'category'
                                )
                                ->all()
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Development Status')
                    ->options([
                        'new_arrival' =>
                            'New Arrival',

                        'ready_for_sampling' =>
                            'Ready for Sampling',

                        'in_development' =>
                            'In Development',
                    ]),

                TernaryFilter::make('sustainable')
                    ->label('Sustainable'),

                TernaryFilter::make('featured')
                    ->label('Featured'),

                TernaryFilter::make('is_active')
                    ->label('Website Visibility'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}