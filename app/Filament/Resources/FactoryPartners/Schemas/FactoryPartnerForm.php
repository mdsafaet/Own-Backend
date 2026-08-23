<?php

namespace App\Filament\Resources\FactoryPartners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FactoryPartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Factory Information')
                    ->description(
                        'Enter the primary information displayed in the factory directory.'
                    )
                    ->schema([
                        TextInput::make('name')
                            ->label('Factory name')
                            ->placeholder('Example: Envoy Group')
                            ->required()
                            ->maxLength(255),

                        Select::make('category')
                            ->label('Product category')
                            ->options([
                                'Woven' => 'Woven',
                                'Knit' => 'Knit',
                                'Sweater' => 'Sweater',
                                'Tailoring' => 'Tailoring',
                                'Activewear' => 'Activewear',
                                'Home Textile' => 'Home Textile',
                            ])
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->required(),

                        Textarea::make('specialization')
                            ->label('Specialization')
                            ->placeholder(
                                'Example: T-Shirts, Polo Shirts, Hoodies'
                            )
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Capacity and Compliance')
                    ->schema([
                        TextInput::make('capacity')
                            ->label('Monthly capacity')
                            ->placeholder('Example: 1.2 Million pcs')
                            ->maxLength(255),

                        Select::make('leed')
                            ->label('LEED status')
                            ->options([
                                'Platinum' => 'Platinum',
                                'Gold' => 'Gold',
                                'Silver' => 'Silver',
                                'Certified' => 'Certified',
                                'Own Factory' => 'Own Factory',
                                'Not Available' => 'Not Available',
                            ])
                            ->searchable()
                            ->native(false),

                        Toggle::make('compliance')
                            ->label('Compliance verified')
                            ->helperText(
                                'Enable this when the factory compliance has been verified.'
                            )
                            ->default(false),
                    ])
                    ->columns(2),

                Section::make('Factory Profile')
                    ->description(
                        'Upload a PDF that visitors can download from the website.'
                    )
                    ->schema([
                        FileUpload::make('profile')
                            ->label('Factory profile PDF')
                            ->disk('public')
                            ->directory('factory-profiles')
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->maxSize(10240)
                            ->downloadable()
                            ->openable()
                            ->helperText(
                                'Only PDF files are allowed. Maximum size: 10 MB.'
                            )
                            ->columnSpanFull(),
                    ]),

                Section::make('Website Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Show in factory directory')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Display order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}