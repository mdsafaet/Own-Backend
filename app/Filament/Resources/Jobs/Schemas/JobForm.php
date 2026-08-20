<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make('Vacancy Information')
                    ->description(
                        'Create and manage a job vacancy.'
                    )
                    ->schema([
                        TextInput::make('title')
                            ->label('Job Title')
                            ->required()
                            ->maxLength(200),

                        TextInput::make('department')
                            ->label('Department')
                            ->required()
                            ->maxLength(150),

                        Select::make('employment_type')
                            ->label('Employment Type')
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                                'Internship' => 'Internship',
                                'Temporary' => 'Temporary',
                            ])
                            ->required(),

                        TextInput::make('location')
                            ->label('Location')
                            ->required()
                            ->maxLength(150),

                        TextInput::make('experience')
                            ->label('Experience')
                            ->placeholder(
                                'Example: 3–5 years'
                            )
                            ->nullable()
                            ->maxLength(150),

                        DatePicker::make('deadline')
                            ->label(
                                'Application Deadline'
                            )
                            ->required()
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->helperText(
                                'Edit this date to extend the application timeline.'
                            ),

                        Textarea::make('summary')
                            ->label('Short Summary')
                            ->placeholder(
                                'Short vacancy description displayed on job cards.'
                            )
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Full Description')
                            ->nullable()
                            ->columnSpanFull(),

                        TagsInput::make('responsibilities')
                            ->label('Responsibilities')
                            ->placeholder(
                                'Enter a responsibility and press Enter'
                            )
                            ->nullable()
                            ->columnSpanFull(),

                        TagsInput::make('requirements')
                            ->label('Requirements')
                            ->placeholder(
                                'Enter a requirement and press Enter'
                            )
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Publishing Settings')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'open' => 'Open',
                                'closed' => 'Closed',
                            ])
                            ->default('draft')
                            ->required(),

                        Toggle::make('featured')
                            ->label(
                                'Highlight on Home Page'
                            )
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
}