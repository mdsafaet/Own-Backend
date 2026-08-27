<?php

namespace App\Filament\Resources\FactoryPartners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
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
                    ->label('Category')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('specialization')
                    ->label('Specialization')
                    ->limit(45)
                    ->tooltip(fn ($state): ?string => $state)
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('compliance')
                    ->label('Compliance verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                TextColumn::make('leed')
                    ->label('LEED')
                    ->badge()
                    ->placeholder('Not specified')
                    ->color(fn (?string $state): string => match ($state) {
                        'Platinum' => 'info',
                        'Gold' => 'warning',
                        'Silver' => 'gray',
                        'Certified' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('Monthly Capacity')
                    ->placeholder('Available on request')
                    ->searchable(),

                IconColumn::make('profile')
                    ->label('Profile PDF')
                    ->boolean(fn ($state): bool => filled($state))
                    ->trueIcon('heroicon-o-document-arrow-down')
                    ->falseIcon('heroicon-o-document')
                    ->trueColor('success')
                    ->falseColor('gray'),

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
                SelectFilter::make('category')
                    ->options([
                        'Woven' => 'Woven',
                        'Knit' => 'Knit',
                        'Sweater' => 'Sweater',
                        'Tailoring' => 'Tailoring',
                        'Activewear' => 'Activewear',
                        'Home Textile' => 'Home Textile',
                    ]),

                TernaryFilter::make('compliance')
                    ->label('Compliance verified'),

                TernaryFilter::make('is_active')
                    ->label('Website visibility'),
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