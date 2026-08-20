<?php

namespace App\Filament\Resources\Leaders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeaderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Leadership Profile')
                    ->description(
                        'Manage the information displayed in the leadership section.'
                    )
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->placeholder('Shahinur Rahman')
                            ->required()
                            ->maxLength(150),

                        TextInput::make('role')
                            ->label('Position / Role')
                            ->placeholder('Founder & Managing Director')
                            ->required()
                            ->maxLength(200),

                        TextInput::make('label')
                            ->label('Profile Label')
                            ->placeholder("Founder's Message")
                            ->nullable()
                            ->maxLength(100),

                        TextInput::make('experience')
                            ->label('Experience')
                            ->placeholder('25+ Years Experience')
                            ->nullable()
                            ->maxLength(100),

                        FileUpload::make('image')
                            ->label('Profile Image')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('leadership')
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->maxSize(4096)
                            ->helperText(
                                'Optional. Recommended portrait ratio: 3:4.'
                            )
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('preview')
                            ->label('Short Introduction')
                            ->placeholder(
                                'Short introduction displayed before the Read More button.'
                            )
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('message')
                            ->label('Full Message')
                            ->placeholder(
                                'Enter the full leadership message. Separate paragraphs using a blank line.'
                            )
                            ->rows(12)
                            ->nullable()
                            ->helperText(
                                'Optional. Leave a blank line between paragraphs.'
                            )
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Publishing')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Show on Website')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}