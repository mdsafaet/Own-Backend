<?php

namespace App\Filament\Resources\ShowroomProducts\Schemas;

use App\Models\ShowroomProduct;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShowroomProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->description(
                        'Enter the information displayed in the product showroom.'
                    )
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Product Title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('product_code')
                            ->label('Product Code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(100),

                        /*
                         * Admin can select an existing suggestion
                         * or type a completely new category.
                         */
                        TextInput::make('category')
                            ->label('Product Category')
                            ->required()
                            ->maxLength(100)
                            ->placeholder(
                                'Select or type a category'
                            )
                            ->datalist(
                                fn (): array =>
                                    static::categorySuggestions()
                            )
                            ->helperText(
                                'Choose an existing category or type a new category name.'
                            ),

                        Select::make('status')
                            ->label('Development Status')
                            ->required()
                            ->default('in_development')
                            ->options([
                                'new_arrival' =>
                                    'New Arrival',

                                'ready_for_sampling' =>
                                    'Ready for Sampling',

                                'in_development' =>
                                    'In Development',
                            ]),

                        Textarea::make('short_description')
                            ->label('Short Description')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ]),

                Section::make('Product Images')
                    ->description(
                        'Upload the main product image and optional gallery images.'
                    )
                    ->schema([
                        FileUpload::make('image')
                            ->label('Primary Image')
                            ->image()
                            ->disk('public')
                            ->directory(
                                'showroom-products'
                            )
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(5120),

                        FileUpload::make('gallery')
                            ->label('Gallery Images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory(
                                'showroom-products/gallery'
                            )
                            ->visibility('public')
                            ->imageEditor()
                            ->maxFiles(8)
                            ->maxSize(5120),
                    ]),

                Section::make('Material Specifications')
                    ->columns(2)
                    ->schema([
                        TextInput::make('fabric')
                            ->label('Fabric')
                            ->placeholder(
                                'Example: Brushed Fleece'
                            )
                            ->maxLength(255),

                        TextInput::make('composition')
                            ->label('Composition')
                            ->placeholder(
                                'Example: 80% Cotton, 20% Polyester'
                            )
                            ->maxLength(255),

                        TextInput::make('gsm')
                            ->label('GSM')
                            ->placeholder(
                                'Example: 320 GSM'
                            )
                            ->maxLength(100),

                        Repeater::make('available_colours')
                            ->label('Available Colours')
                            ->simple(
                                TextInput::make('colour')
                                    ->required()
                                    ->maxLength(100)
                            )
                            ->defaultItems(0)
                            ->addActionLabel('Add Colour')
                            ->columnSpanFull(),
                    ]),

                Section::make('Commercial Information')
                    ->description(
                        'These values may be left empty when they are not confirmed.'
                    )
                    ->columns(3)
                    ->schema([
                        TextInput::make('moq')
                            ->label('MOQ')
                            ->placeholder(
                                'Example: 800 pcs per colour'
                            )
                            ->maxLength(150),

                        TextInput::make('sample_lead_time')
                            ->label('Sample Lead Time')
                            ->placeholder(
                                'Example: 10–14 days'
                            )
                            ->maxLength(150),

                        TextInput::make(
                            'production_lead_time'
                        )
                            ->label(
                                'Production Lead Time'
                            )
                            ->placeholder(
                                'Example: 50–60 days'
                            )
                            ->maxLength(150),
                    ]),

                Section::make('Product Features')
                    ->schema([
                        Repeater::make('features')
                            ->label('Features')
                            ->simple(
                                TextInput::make('feature')
                                    ->required()
                                    ->maxLength(255)
                            )
                            ->defaultItems(0)
                            ->addActionLabel(
                                'Add Feature'
                            ),
                    ]),

                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        Toggle::make('sustainable')
                            ->label(
                                'Sustainable Product'
                            )
                            ->default(false),

                        Toggle::make('featured')
                            ->label('Featured Product')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label(
                                'Visible on Website'
                            )
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                    ]),
            ]);
    }

    /*
     * Returns both the default categories and
     * categories previously entered by the admin.
     */
    private static function categorySuggestions(): array
    {
        $defaultCategories = [
            'Knitwear',
            'Woven Apparel',
            'Sweaters',
            'Activewear',
            'Tailored Garments',
            'Home Textiles',
        ];

        $savedCategories = ShowroomProduct::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->all();

        return collect([
            ...$defaultCategories,
            ...$savedCategories,
        ])
            ->map(
                fn (string $category): string =>
                    trim($category)
            )
            ->filter()
            ->unique(
                fn (string $category): string =>
                    strtolower($category)
            )
            ->sort()
            ->values()
            ->all();
    }
} 