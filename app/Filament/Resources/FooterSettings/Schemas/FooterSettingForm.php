<?php

namespace App\Filament\Resources\FooterSettings\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FooterSettingForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make(
                    'Company Information'
                )
                    ->description(
                        'Manage the company information displayed in the footer.'
                    )
                    ->schema([
                        TextInput::make(
                            'brand_title'
                        )
                            ->label(
                                'Company Name'
                            )
                            ->placeholder(
                                'Own Sourcing International'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'brand_url'
                        )
                            ->label(
                                'Company Link'
                            )
                            ->placeholder('/')
                            ->maxLength(255)
                            ->nullable(),

                        Textarea::make(
                            'description'
                        )
                            ->rows(5)
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make(
                            'button_text'
                        )
                            ->label(
                                'Button Text'
                            )
                            ->placeholder(
                                'Send Inquiry'
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
                                '/contact#inquiry'
                            )
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make(
                    'Footer Navigation'
                )
                    ->description(
                        'Create navigation columns and their links.'
                    )
                    ->schema([
                        Repeater::make(
                            'link_columns'
                        )
                            ->label(
                                'Navigation Columns'
                            )
                            ->schema([
                                TextInput::make(
                                    'title'
                                )
                                    ->label(
                                        'Column Title'
                                    )
                                    ->placeholder(
                                        'Company'
                                    )
                                    ->required()
                                    ->maxLength(100),

                                Repeater::make(
                                    'links'
                                )
                                    ->label('Links')
                                    ->schema([
                                        TextInput::make(
                                            'label'
                                        )
                                            ->label(
                                                'Link Label'
                                            )
                                            ->required()
                                            ->maxLength(
                                                100
                                            ),

                                        TextInput::make(
                                            'href'
                                        )
                                            ->label(
                                                'Link URL'
                                            )
                                            ->placeholder(
                                                '/about'
                                            )
                                            ->required()
                                            ->maxLength(
                                                255
                                            ),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(1)
                                    ->addActionLabel(
                                        'Add Link'
                                    )
                                    ->reorderable()
                                    ->collapsible(),
                            ])
                            ->defaultItems(2)
                            ->addActionLabel(
                                'Add Navigation Column'
                            )
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(
                                fn (array $state):
                                    ?string =>
                                        $state['title']
                                            ?? 'Navigation Column'
                            )
                            ->columnSpanFull(),
                    ]),

                Section::make(
                    'Office Information'
                )
                    ->schema([
                        TextInput::make(
                            'office_title'
                        )
                            ->label(
                                'Office Heading'
                            )
                            ->placeholder(
                                'Head Office — Dhaka'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        Textarea::make(
                            'address'
                        )
                            ->rows(4)
                            ->nullable(),

                        TextInput::make(
                            'phone'
                        )
                            ->tel()
                            ->placeholder(
                                '+880 1700-000000'
                            )
                            ->maxLength(100)
                            ->nullable(),

                        TextInput::make(
                            'email'
                        )
                            ->email()
                            ->placeholder(
                                'hello@ownsourcing.com'
                            )
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make(
                    'Bottom Bar'
                )
                    ->schema([
                        TextInput::make(
                            'copyright_text'
                        )
                            ->label(
                                'Copyright Text'
                            )
                            ->placeholder(
                                '© {year} Own Sourcing International. All rights reserved.'
                            )
                            ->helperText(
                                'Use {year} to display the current year automatically.'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make(
                            'locations_text'
                        )
                            ->label(
                                'Locations'
                            )
                            ->placeholder(
                                'Dhaka · Hong Kong · Sydney'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        Toggle::make(
                            'is_active'
                        )
                            ->label(
                                'Show CMS footer'
                            )
                            ->helperText(
                                'If disabled, the frontend displays its default footer.'
                            )
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}