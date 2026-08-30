<?php

namespace App\Filament\Resources\EqwoolsProductApplications\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EqwoolsProductApplicationForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make(
                    'Product Application'
                )
                    ->description(
                        'Manage an EQWOOLS product application displayed on the website.'
                    )
                    ->schema([
                        TextInput::make(
                            'category'
                        )
                            ->label(
                                'Application Category'
                            )
                            ->placeholder(
                                'Premium Knitwear'
                            )
                            ->required()
                            ->maxLength(255),

                        Textarea::make(
                            'description'
                        )
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label(
                                'Application Image'
                            )
                            ->image()
                            ->disk('public')
                            ->directory(
                                'eqwools/product-applications'
                            )
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(5120)
                            ->nullable(),

                        TextInput::make(
                            'image_alt'
                        )
                            ->label(
                                'Image Alternative Text'
                            )
                            ->helperText(
                                'Describe the image for accessibility.'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TagsInput::make(
                            'products'
                        )
                            ->label(
                                'Finished Products'
                            )
                            ->placeholder(
                                'Add a finished product'
                            )
                            ->helperText(
                                'Press Enter after every product.'
                            )
                            ->nullable()
                            ->columnSpanFull(),

                        TagsInput::make(
                            'fabrics'
                        )
                            ->label(
                                'Fabric Possibilities'
                            )
                            ->placeholder(
                                'Add a fabric'
                            )
                            ->helperText(
                                'Press Enter after every fabric.'
                            )
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(
                    'Publishing'
                )
                    ->schema([
                        Toggle::make(
                            'is_active'
                        )
                            ->label(
                                'Show on website'
                            )
                            ->helperText(
                                'Disable this to hide the application from the website.'
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
                    ->columns(2),
            ]);
    }
}