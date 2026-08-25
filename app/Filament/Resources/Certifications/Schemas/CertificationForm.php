<?php

namespace App\Filament\Resources\Certifications\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Certification')
                    ->description(
                        'All content fields are optional. Add at least a logo or title for a useful item.'
                    )
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Certification Title')
                            ->placeholder(
                                'Example: OEKO-TEX®'
                            )
                            ->maxLength(255),

                        TextInput::make('logo_alt')
                            ->label('Logo Alternative Text')
                            ->placeholder(
                                'Example: OEKO-TEX certification logo'
                            )
                            ->maxLength(255)
                            ->helperText(
                                'Used by screen readers when a logo is available.'
                            ),

                        FileUpload::make('logo')
                            ->label('Certification Logo')
                            ->image()
                            ->disk('public')
                            ->directory(
                                'certifications/logos'
                            )
                            ->visibility('public')
                            ->imageEditor()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/svg+xml',
                            ])
                            ->maxSize(3072)
                            ->columnSpanFull(),

                        TextInput::make('website_url')
                            ->label('Certification Website')
                            ->url()
                            ->placeholder(
                                'https://example.com'
                            )
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Visible on Website')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                    ]),
            ]);
    }
}