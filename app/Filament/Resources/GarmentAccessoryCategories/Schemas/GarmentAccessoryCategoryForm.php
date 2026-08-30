<?php

namespace App\Filament\Resources\GarmentAccessoryCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GarmentAccessoryCategoryForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make(
                    'Accessory Category'
                )
                    ->description(
                        'Manage an accessory category displayed on the website.'
                    )
                    ->schema([
                        TextInput::make('title')
                            ->label(
                                'Category Title'
                            )
                            ->placeholder(
                                'Labels & Branding'
                            )
                            ->required()
                            ->maxLength(255),

                        Select::make('icon')
                            ->label('Icon')
                            ->options([
                                'tags' =>
                                    'Tags',

                                'badge-check' =>
                                    'Badge Check',

                                'package' =>
                                    'Package',

                                'layers' =>
                                    'Layers',

                                'scissors' =>
                                    'Scissors',

                                'shirt' =>
                                    'Shirt',

                                'box' =>
                                    'Box',

                                'sparkles' =>
                                    'Sparkles',
                            ])
                            ->searchable()
                            ->nullable(),

                        Textarea::make(
                            'description'
                        )
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label(
                                'Category Image'
                            )
                            ->image()
                            ->disk('public')
                            ->directory(
                                'garment-accessories/categories'
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
                                'Describe the image for accessibility and SEO.'
                            )
                            ->maxLength(255)
                            ->nullable(),

                        TagsInput::make(
                            'products'
                        )
                            ->label(
                                'Products'
                            )
                            ->placeholder(
                                'Add a product'
                            )
                            ->helperText(
                                'Type a product name and press Enter.'
                            )
                            ->nullable()
                            ->columnSpanFull(),
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
                                'Disable this to hide the category.'
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