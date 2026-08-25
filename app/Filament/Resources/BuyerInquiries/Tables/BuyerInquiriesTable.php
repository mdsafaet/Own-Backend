<?php

namespace App\Filament\Resources\BuyerInquiries\Tables;

use App\Models\BuyerInquiry;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class BuyerInquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Reference')
                    ->formatStateUsing(
                        fn (int $state): string =>
                            sprintf('BI-%06d', $state)
                    )
                    ->searchable(),

                TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('contact_person')
                    ->label('Contact')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('product_code')
                    ->label('Product Code')
                    ->searchable()
                    ->placeholder('Not specified'),

                TextColumn::make('estimated_quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->placeholder('Not specified'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string =>
                            match ($state) {
                                'new' => 'New',
                                'reviewing' => 'Reviewing',
                                'contacted' => 'Contacted',
                                'quoted' => 'Quotation Sent',
                                'closed' => 'Closed',
                                'spam' => 'Spam',
                                default => $state,
                            }
                    )
                    ->color(
                        fn (string $state): string =>
                            match ($state) {
                                'new' => 'danger',
                                'reviewing' => 'warning',
                                'contacted' => 'info',
                                'quoted' => 'success',
                                'closed' => 'gray',
                                'spam' => 'gray',
                                default => 'gray',
                            }
                    ),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'reviewing' => 'Reviewing',
                        'contacted' => 'Contacted',
                        'quoted' => 'Quotation Sent',
                        'closed' => 'Closed',
                        'spam' => 'Spam',
                    ]),
            ])
            ->recordActions([
                Action::make('downloadAttachment')
                    ->label('Download File')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(
                        fn (
                            BuyerInquiry $record
                        ): bool =>
                            filled($record->attachment)
                    )
                    ->url(
                        fn (
                            BuyerInquiry $record
                        ): string =>
                            Storage::disk('public')->url(
                                $record->attachment
                            )
                    )
                    ->openUrlInNewTab(),

                Action::make('markContacted')
                    ->label('Mark Contacted')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(
                        fn (
                            BuyerInquiry $record
                        ): bool =>
                            $record->status !== 'contacted'
                    )
                    ->action(
                        function (
                            BuyerInquiry $record
                        ): void {
                            $record->update([
                                'status' => 'contacted',
                                'contacted_at' => now(),
                            ]);

                            Notification::make()
                                ->title(
                                    'Inquiry marked as contacted'
                                )
                                ->success()
                                ->send();
                        }
                    ),

                EditAction::make()
                    ->label('Open'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}