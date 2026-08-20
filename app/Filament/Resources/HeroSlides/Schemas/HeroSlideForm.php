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
                        'Upload the background image for this carousel slide.'
                    )
                    ->schema([
                        FileUpload::make('image')
                            ->label('Background Image')
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
                            ->imagePreviewHeight('250')
                            ->maxSize(5120)
                            ->required()
                            ->helperText(
                                'Recommended size: 1920 × 1080 pixels. Maximum size: 5 MB.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('alt')
                            ->label('Image Alternative Text')
                            ->placeholder(
                                'Apparel sourcing and garment manufacturing'
                            )
                            ->maxLength(255)
                            ->helperText(
                                'Optional. Describe the image for accessibility.'
                            )
                            ->columnSpanFull(),
                    ]),

                Section::make('Slide Content')
                    ->description(
                        'All content fields are optional.'
                    )
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Small Heading')
                            ->placeholder(
                                'Trusted apparel sourcing from Bangladesh'
                            )
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Main Title')
                            ->placeholder('Your Vision.')
                            ->maxLength(255),

                        TextInput::make(
                            'highlighted_title'
                        )
                            ->label('Highlighted Title')
                            ->placeholder(
                                'Our Sourcing Excellence.'
                            )
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder(
                                'Connecting global fashion brands with reliable apparel manufacturers.'
                            )
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Primary Button')
                    ->description(
                        'Leave both fields empty to hide the primary button.'
                    )
                    ->schema([
                        TextInput::make(
                            'primary_button_label'
                        )
                            ->label('Button Text')
                            ->placeholder(
                                'Send Us Your Inquiry'
                            )
                            ->maxLength(100),

                        TextInput::make(
                            'primary_button_link'
                        )
                            ->label('Button Link')
                            ->placeholder(
                                '/contact#inquiry'
                            )
                            ->maxLength(500)
                            ->helperText(
                                'You can use an internal path such as /contact or a complete external URL.'
                            ),
                    ])
                    ->columns(2),

                Section::make('Secondary Button')
                    ->description(
                        'Leave both fields empty to hide the secondary button.'
                    )
                    ->schema([
                        TextInput::make(
                            'secondary_button_label'
                        )
                            ->label('Button Text')
                            ->placeholder(
                                'Explore Our Services'
                            )
                            ->maxLength(100),

                        TextInput::make(
                            'secondary_button_link'
                        )
                            ->label('Button Link')
                            ->placeholder('/services')
                            ->maxLength(500)
                            ->helperText(
                                'You can use an internal path such as /services or a complete external URL.'
                            ),
                    ])
                    ->columns(2),

                Section::make('Display Settings')
                    ->schema([
                        Select::make('position')
                            ->label('Content Position')
                            ->options([
                                'left' => 'Left',
                                'right' => 'Right',
                            ])
                            ->default('left')
                            ->native(false)
                            ->required(),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->helperText(
                                'Only active slides will appear on the website.'
                            )
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
}