<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make('Slide Image')
                    ->description(
                        'The image is required. All text and link fields are optional.'
                    )
                    ->schema([
                        FileUpload::make('image')
                            ->label('Product Image')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/avif',
                            ])
                            ->disk('public')
                            ->directory('hero-slides')
                            ->visibility('public')
                            ->imagePreviewHeight('260')
                            ->maxSize(10240 )
                            ->required()
                            ->helperText(
                                'Recommended: 1200 × 1500 pixels. Maximum: 10 MB.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('alt')
                            ->label('Image Alternative Text')
                            ->placeholder(
                                'Knitwear product development'
                            )
                            ->maxLength(255)
                            ->helperText(
                                'Optional, but recommended for accessibility.'
                            )
                            ->columnSpanFull(),
                    ]),

                Section::make('Card Content')
                    ->description(
                        'Leave these fields empty when you want to display only the image.'
                    )
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Knitwear')
                            ->maxLength(255),

                        TextInput::make(
                            'highlighted_title'
                        )
                            ->label('Short Highlight')
                            ->placeholder(
                                'Premium product development'
                            )
                            ->maxLength(255),

                        TextInput::make('eyebrow')
                            ->label('Small Label')
                            ->placeholder('Product Category')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder(
                                'Premium yarns and advanced knitting capabilities.'
                            )
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Optional Link')
                    ->description(
                        'Leave both fields empty if the image card should not have a link.'
                    )
                    ->schema([
                        TextInput::make(
                            'primary_button_label'
                        )
                            ->label('Link Text')
                            ->placeholder('Explore Category')
                            ->maxLength(100),

                        TextInput::make(
                            'primary_button_link'
                        )
                            ->label('Link URL')
                            ->placeholder(
                                '/products/apparels'
                            )
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Section::make('Display Settings')
                    ->schema([
                        Select::make('position')
                            ->label('Image Position')
                            ->options([
                                'left' => 'Left',
                                'center' => 'Center',
                                'right' => 'Right',
                            ])
                            ->default('center')
                            ->native(false)
                            ->required(),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Visible')
                            ->helperText(
                                'Only visible slides appear on the website.'
                            )
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
}