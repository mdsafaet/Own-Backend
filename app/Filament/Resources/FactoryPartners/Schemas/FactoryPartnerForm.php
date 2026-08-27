<?php

namespace App\Filament\Resources\FactoryPartners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    ->description('Enter the information displayed in the factory directory.')
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
                            ->placeholder('Example: Shirts, trousers, jackets and shorts')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Capacity and Compliance')
                    ->schema([
                        TextInput::make('capacity')
                            ->label('Monthly capacity')
                            ->placeholder('Example: 540,000 pcs/month')
                            ->maxLength(255)
                            ->helperText('Leave empty when the monthly capacity is not confirmed.'),

                        Select::make('leed')
                            ->label('LEED status')
                            ->options([
                                'Platinum' => 'LEED Platinum',
                                'Gold' => 'LEED Gold',
                                'Silver' => 'LEED Silver',
                                'Certified' => 'LEED Certified',
                            ])
                            ->placeholder('Not specified')
                            ->native(false)
                            ->nullable()
                            ->helperText('Select a value only when the LEED certification is confirmed.'),

                        Toggle::make('compliance')
                            ->label('Compliance verified')
                            ->helperText('Enable this when the factory compliance information has been verified.')
                            ->default(false)
                            ->onColor('success')
                            ->offColor('gray'),
                    ])
                    ->columns(2),

                Section::make('Factory Profile')
                    ->description('Upload the factory PDF that visitors can download.')
                    ->schema([
                        FileUpload::make('profile')
                            ->label('Factory profile PDF')
                            ->disk('public')
                            ->directory('factory-profiles')
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->maxSize(51200)
                            ->downloadable()
                            ->openable()
                            ->helperText('Only PDF files are allowed. Maximum size: 50 MB.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Website Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Show in factory directory')
                            ->helperText('Disable this to hide the factory from the public website.')
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