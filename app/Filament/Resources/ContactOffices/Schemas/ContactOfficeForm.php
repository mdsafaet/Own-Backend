<?php

namespace App\Filament\Resources\ContactOffices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactOfficeForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make(
                    'Office Information'
                )
                    ->schema([
                        TextInput::make(
                            'country'
                        )
                            ->placeholder(
                                'Bangladesh'
                            )
                            ->required()
                            ->maxLength(255),

                        TextInput::make('title')
                            ->placeholder(
                                'Head Office'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'company'
                        )
                            ->placeholder(
                                'Own Sourcing International'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        Select::make('icon')
                            ->options([
                                'building' =>
                                    'Office Building',

                                'globe' =>
                                    'Global Office',
                            ])
                            ->default('globe')
                            ->required(),

                        TextInput::make(
                            'person'
                        )
                            ->label(
                                'Contact Person'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'designation'
                        )
                            ->maxLength(255)
                            ->nullable(),

                        TagsInput::make(
                            'address_lines'
                        )
                            ->label(
                                'Address Lines'
                            )
                            ->placeholder(
                                'Add an address line'
                            )
                            ->helperText(
                                'Enter each address line separately and press Enter.'
                            )
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(
                    'Contact Details'
                )
                    ->schema([
                        TextInput::make(
                            'phone'
                        )
                            ->tel()
                            ->placeholder(
                                '+88 02-44806631-32'
                            )
                            ->maxLength(100)
                            ->nullable(),

                        TextInput::make(
                            'mobile'
                        )
                            ->tel()
                            ->placeholder(
                                '+88 01726-339903'
                            )
                            ->maxLength(100)
                            ->nullable(),

                        TextInput::make(
                            'whatsapp'
                        )
                            ->label(
                                'WhatsApp Number'
                            )
                            ->placeholder(
                                '8801726339903'
                            )
                            ->helperText(
                                'Enter the country code and number without spaces or the plus sign.'
                            )
                            ->maxLength(100)
                            ->nullable(),

                        TextInput::make(
                            'email'
                        )
                            ->email()
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make(
                    'Display Settings'
                )
                    ->schema([
                        Toggle::make(
                            'featured'
                        )
                            ->label(
                                'Featured Office'
                            )
                            ->helperText(
                                'Featured offices use the dark card style.'
                            )
                            ->default(false),

                        Toggle::make(
                            'is_active'
                        )
                            ->label(
                                'Show on website'
                            )
                            ->default(true),

                        TextInput::make(
                            'sort_order'
                        )
                            ->label(
                                'Display Order'
                            )
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
}