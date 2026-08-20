<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Header Branding')
                    ->description(
                        'Manage the logo and text displayed in the website header.'
                    )
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Header Logo')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/svg+xml',
                            ])
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->imagePreviewHeight('120')
                            ->maxSize(2048)
                            ->helperText(
                                'Upload PNG, JPG, WebP or SVG. Maximum size: 2 MB.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('logo_alt')
                            ->label('Logo Alternative Text')
                            ->placeholder(
                                'Own Sourcing International'
                            )
                            ->maxLength(255)
                            ->helperText(
                                'Used when the logo cannot be displayed and for accessibility.'
                            )
                            ->columnSpanFull(),

                        TextInput::make('site_title')
                            ->label('Header Title')
                            ->placeholder('Own Sourcing')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('site_subtitle')
                            ->label('Header Subtitle')
                            ->placeholder('International')
                            ->maxLength(100),
                    ])
                    ->columns(2),
            ]);
    }
}