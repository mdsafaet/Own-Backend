<?php

namespace App\Filament\Resources\ProductHeroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductHeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Content')
                    ->description(
                        'All fields are optional. Empty content will not appear on the website.'
                    )
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Small heading')
                            ->placeholder('Our Products')
                            ->maxLength(255),

                        TextInput::make('title')
                            ->label('Main title')
                            ->placeholder('Product categories')
                            ->maxLength(255),

                        TextInput::make('highlighted_title')
                            ->label('Highlighted title')
                            ->placeholder('we handle.')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Background Image')
                    ->schema([
                        FileUpload::make('background_image')
                            ->label('Hero background image')
                            ->image()
                            ->disk('public')
                            ->directory('product-heroes')
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/avif',
                            ])
                            ->maxSize(5120)
                            ->helperText(
                                'Recommended size: 1920 × 900 pixels. Maximum size: 5 MB.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('image_alt')
                            ->label('Image alternative text')
                            ->placeholder('Apparel product categories')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Primary Button')
                    ->description(
                        'Both text and URL must be provided for the button to appear.'
                    )
                    ->schema([
                        TextInput::make('primary_button_text')
                            ->label('Button text')
                            ->placeholder('Explore Products')
                            ->maxLength(100),

                        TextInput::make('primary_button_url')
                            ->label('Button link')
                            ->placeholder('#categories')
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Section::make('Secondary Button')
                    ->description(
                        'Both text and URL must be provided for the button to appear.'
                    )
                    ->schema([
                        TextInput::make('secondary_button_text')
                            ->label('Button text')
                            ->placeholder('Fabric Capabilities')
                            ->maxLength(100),

                        TextInput::make('secondary_button_url')
                            ->label('Button link')
                            ->placeholder('#fabrics')
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Show hero on website')
                            ->default(true),
                    ]),
            ]);
    }
}