<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->description('Manage the category title, description and image.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Category title')
                            ->placeholder('Example: Woven Apparel')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->label('Category subtitle')
                            ->placeholder(
                                'Example: Structured essentials for everyday collections'
                            )
                            ->maxLength(255),

                        FileUpload::make('image')
                            ->label('Product category image')
                            ->image()
                            ->disk('public')
                            ->directory('product-categories')
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/avif',
                            ])
                            ->maxSize(5120)
                            ->helperText(
                                'Recommended size: 1200 × 900 pixels. Maximum: 5 MB.'
                            )
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Product Details')
                    ->description(
                        'Add the products displayed inside this category card.'
                    )
                    ->schema([
                        Repeater::make('products')
                            ->label('Products')
                            ->simple(
                                TextInput::make('product')
                                    ->required()
                                    ->maxLength(150)
                            )
                            ->addActionLabel('Add product')
                            ->reorderable()
                            ->defaultItems(1)
                            ->columnSpanFull(),

                        Repeater::make('collections')
                            ->label('Collections')
                            ->simple(
                                TextInput::make('collection')
                                    ->required()
                                    ->maxLength(150)
                            )
                            ->addActionLabel('Add collection')
                            ->reorderable()
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),

                Section::make('Visibility and Order')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Show on website')
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