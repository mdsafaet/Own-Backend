<?php

namespace App\Filament\Resources\Jobs\RelationManagers;

use App\Models\JobApplication;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ApplicationsRelationManager
    extends RelationManager
{
    protected static string $relationship =
        'applications';

    protected static ?string $title =
        'Job Applications';

    protected static ?string $modelLabel =
        'Application';

    protected static ?string $pluralModelLabel =
        'Applications';

    public function form(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make(
                    'Applicant Information'
                )
                    ->description(
                        'Review applicant details and update the application status.'
                    )
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->disabled(),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->disabled(),

                        TextInput::make(
                            'current_company'
                        )
                            ->label(
                                'Current Company'
                            )
                            ->disabled(),

                        TextInput::make(
                            'current_position'
                        )
                            ->label(
                                'Current Position'
                            )
                            ->disabled(),

                        Textarea::make(
                            'cover_letter'
                        )
                            ->label('Cover Letter')
                            ->rows(8)
                            ->disabled()
                            ->columnSpanFull(),

                        Select::make('status')
                            ->label(
                                'Application Status'
                            )
                            ->options([
                                'new' => 'New',
                                'reviewing' =>
                                    'Reviewing',
                                'shortlisted' =>
                                    'Shortlisted',
                                'rejected' =>
                                    'Rejected',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(
        Table $table
    ): Table {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Applicant')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->copyable()
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make(
                    'current_company'
                )
                    ->label('Company')
                    ->placeholder(
                        'Not provided'
                    )
                    ->toggleable(),

                TextColumn::make(
                    'current_position'
                )
                    ->label('Position')
                    ->placeholder(
                        'Not provided'
                    ),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(
                        fn (
                            string $state
                        ): string => match ($state) {
                            'shortlisted' =>
                                'success',
                            'rejected' =>
                                'danger',
                            'reviewing' =>
                                'warning',
                            default => 'info',
                        }
                    ),

                TextColumn::make('created_at')
                    ->label('Applied On')
                    ->dateTime(
                        'd M Y, h:i A'
                    )
                    ->sortable(),
            ])
            ->defaultSort(
                'created_at',
                'desc'
            )
            ->headerActions([])
            ->recordActions([
                Action::make('downloadCv')
                    ->label('Download CV')
                    ->icon(
                        'heroicon-o-arrow-down-tray'
                    )
                    ->color('success')
                    ->visible(
                        fn (
                            JobApplication $record
                        ): bool =>
                            filled($record->cv_path)
                            && Storage::disk(
                                'local'
                            )->exists(
                                $record->cv_path
                            )
                    )
                    ->action(
                        fn (
                            JobApplication $record
                        ) =>
                            Storage::disk('local')
                                ->download(
                                    $record->cv_path
                                )
                    ),

                EditAction::make()
                    ->label('Review')
                    ->icon('heroicon-o-eye'),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}