<?php

namespace App\Filament\Resources\PurposeSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PurposeSectionForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make('Purpose Image')
                    ->description(
                        'Manage the image and experience badge shown on the Home page.'
                    )
                    ->schema([
                        FileUpload::make('image')
                            ->label('Purpose Section Image')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/avif',
                            ])
                            ->disk('public')
                            ->directory('home/purpose')
                            ->visibility('public')
                            ->imagePreviewHeight('300')
                            ->maxSize(5120)
                            ->helperText(
                                'Recommended image size: 1200 × 1000 pixels.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('image_alt')
                            ->label('Image Alternative Text')
                            ->placeholder(
                                'Apparel manufacturing team'
                            )
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('experience_value')
                            ->label('Experience Value')
                            ->placeholder('25+')
                            ->maxLength(50),

                        TextInput::make('experience_label')
                            ->label('Experience Label')
                            ->placeholder(
                                'Years of industry knowledge'
                            )
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }
}