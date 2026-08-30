<?php

namespace App\Filament\Resources\EqwoolsHeroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EqwoolsHeroForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make('Hero Content')
                    ->description(
                        'Manage the content shown in the EQWOOLS page hero.'
                    )
                    ->schema([
                        TextInput::make(
                            'eyebrow'
                        )
                            ->label(
                                'Small Heading'
                            )
                            ->placeholder(
                                'Exclusive Bangladesh Representative'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'title'
                        )
                            ->label('Main Title')
                            ->placeholder(
                                'Premium Australian'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'highlighted_title'
                        )
                            ->label(
                                'Highlighted Title'
                            )
                            ->placeholder(
                                'Merino wool solutions.'
                            )
                            ->helperText(
                                'This line appears in the lime italic style.'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        Textarea::make(
                            'description'
                        )
                            ->rows(5)
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(
                    'Background Image'
                )
                    ->schema([
                        FileUpload::make(
                            'background_image'
                        )
                            ->label(
                                'Hero Background Image'
                            )
                            ->image()
                            ->disk('public')
                            ->directory(
                                'eqwools/hero'
                            )
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(10240)
                            ->nullable(),

                        TextInput::make(
                            'image_alt'
                        )
                            ->label(
                                'Image Alternative Text'
                            )
                            ->placeholder(
                                'Premium Australian Merino wool'
                            )
                            ->helperText(
                                'Describe the image for accessibility and SEO.'
                            )
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make(
                    'Call-to-Action Button'
                )
                    ->schema([
                        TextInput::make(
                            'button_text'
                        )
                            ->label(
                                'Button Text'
                            )
                            ->placeholder(
                                'Explore Product Applications'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'button_url'
                        )
                            ->label(
                                'Button Link'
                            )
                            ->placeholder(
                                '#applications'
                            )
                            ->helperText(
                                'Use #applications for the Product Applications section.'
                            )
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make('Publishing')
                    ->schema([
                        Toggle::make(
                            'is_active'
                        )
                            ->label(
                                'Show on website'
                            )
                            ->helperText(
                                'Only the first active EQWOOLS hero is returned by the API.'
                            )
                            ->default(true),
                    ]),
            ]);
    }
}