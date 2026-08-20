<?php

namespace App\Filament\Resources\Jobs\Tables;

use App\Models\Job;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JobsTable
{
    public static function configure(
        Table $table
    ): Table {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Vacancy')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('department')
                    ->label('Department')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Not provided'),

                TextColumn::make(
                    'employment_type'
                )
                    ->label('Type')
                    ->badge()
                    ->placeholder('Not provided'),

                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d M Y')
                    ->sortable()
                    ->color(
                        fn (Job $record): string =>
                            $record->deadline
                                ->copy()
                                ->endOfDay()
                                ->isPast()
                                ? 'danger'
                                : 'success'
                    ),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(
                        fn (
                            string $state
                        ): string => match ($state) {
                            'open' => 'success',
                            'closed' => 'danger',
                            default => 'gray',
                        }
                    ),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make(
                    'applications_count'
                )
                    ->label('Applicants')
                    ->counts('applications')
                    ->badge()
                    ->color('info'),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable()
                    ->toggleable(
                        isToggledHiddenByDefault: true
                    ),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                Action::make('extendDeadline')
                    ->label('Extend')
                    ->tooltip(
                        'Extend application deadline'
                    )
                    ->icon(
                        'heroicon-o-calendar-days'
                    )
                    ->color('warning')
                    ->schema([
                        DatePicker::make('deadline')
                            ->label(
                                'New Application Deadline'
                            )
                            ->required()
                            ->native(false)
                            ->minDate(today()),
                    ])
                    ->fillForm(
                        fn (Job $record): array => [
                            'deadline' =>
                                $record->deadline,
                        ]
                    )
                    ->action(function (
                        Job $record,
                        array $data
                    ): void {
                        $record->update([
                            'deadline' =>
                                $data['deadline'],
                            'status' => 'open',
                        ]);

                        Notification::make()
                            ->title(
                                'Deadline extended successfully'
                            )
                            ->body(
                                'The vacancy has been reopened and can accept applications.'
                            )
                            ->success()
                            ->send();
                    }),

                Action::make('closeVacancy')
                    ->label('Close')
                    ->icon(
                        'heroicon-o-lock-closed'
                    )
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(
                        'Close this vacancy?'
                    )
                    ->modalDescription(
                        'Applicants will no longer be able to submit CVs.'
                    )
                    ->visible(
                        fn (Job $record): bool =>
                            $record->status === 'open'
                    )
                    ->action(function (
                        Job $record
                    ): void {
                        $record->update([
                            'status' => 'closed',
                        ]);

                        Notification::make()
                            ->title('Vacancy closed')
                            ->success()
                            ->send();
                    }),

                Action::make('reopenVacancy')
                    ->label('Reopen')
                    ->icon(
                        'heroicon-o-lock-open'
                    )
                    ->color('success')
                    ->visible(
                        fn (Job $record): bool =>
                            $record->status === 'closed'
                            && $record->deadline
                                ->copy()
                                ->endOfDay()
                                ->isFuture()
                    )
                    ->action(function (
                        Job $record
                    ): void {
                        $record->update([
                            'status' => 'open',
                        ]);

                        Notification::make()
                            ->title('Vacancy reopened')
                            ->success()
                            ->send();
                    }),

                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}