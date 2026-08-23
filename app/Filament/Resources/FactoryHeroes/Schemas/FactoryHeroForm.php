<?php

namespace App\Filament\Resources\FactoryHeroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FactoryHeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Content')
                    ->description(
                        'All content fields are optional. Empty content will be hidden.'
                    )
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Small heading')
                            ->placeholder('Factory Matrix')
                            ->maxLength(255),

                        TextInput::make('title')
                            ->label('Main title')
                            ->placeholder(
                                'Manufacturing excellence'
                            )
                            ->maxLength(255),

                        TextInput::make('highlighted_title')
                            ->label('Highlighted title')
                            ->placeholder('you can trust.')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder(
                                'A carefully developed network of reliable manufacturers.'
                            )
                            ->rows(4)
                            ->maxLength(1500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Background Image')
                    ->schema([
                        FileUpload::make('background_image')
                            ->label('Hero background image')
                            ->image()
                            ->disk('public')
                            ->directory('factory-heroes')
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/avif',
                            ])
                            ->maxSize(5120)
                            ->helperText(
                                'Recommended size: 1920 × 900 pixels. Maximum 5 MB.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('image_alt')
                            ->label('Image alternative text')
                            ->placeholder(
                                'Apparel manufacturing factory in Bangladesh'
                            )
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Primary Button')
                    ->description(
                        'The button appears only when both fields are provided.'
                    )
                    ->schema([
                        TextInput::make('primary_button_text')
                            ->label('Button text')
                            ->placeholder(
                                'Explore Factory Matrix'
                            )
                            ->maxLength(100),

                        TextInput::make('primary_button_url')
                            ->label('Button URL')
                            ->placeholder('#factory-list')
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Section::make('Secondary Button')
                    ->description(
                        'The button appears only when both fields are provided.'
                    )
                    ->schema([
                        TextInput::make('secondary_button_text')
                            ->label('Button text')
                            ->placeholder('Factory Profiles')
                            ->maxLength(100),

                        TextInput::make('secondary_button_url')
                            ->label('Button URL')
                            ->placeholder('#factory-profiles')
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Section::make('Trust Items')
                    ->description(
                        'Small trust indicators displayed below the buttons.'
                    )
                    ->schema([
                        Repeater::make('trust_items')
                            ->label('Trust indicators')
                            ->simple(
                                TextInput::make('item')
                                    ->placeholder(
                                        'Example: Verified Partners'
                                    )
                                    ->required()
                                    ->maxLength(100)
                            )
                            ->addActionLabel('Add trust item')
                            ->reorderable()
                            ->maxItems(6)
                            ->columnSpanFull(),
                    ]),

                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Show hero on website')
                            ->default(true),
                    ]),
            ]);
    }
}