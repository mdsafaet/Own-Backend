<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Reviewer Information')
                    ->description(
                        'Add the reviewer’s name, organization and photograph.'
                    )
                    ->schema([
                        TextInput::make('name')
                            ->label('Reviewer Name')
                            ->required()
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Please enter the reviewer name.',
                            ]),

                        TextInput::make('company')
                            ->label('Company')
                            ->nullable()
                            ->maxLength(255),

                        TextInput::make('designation')
                            ->label('Designation')
                            ->nullable()
                            ->maxLength(255),

                        FileUpload::make('image')
                            ->label('Reviewer Image')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('testimonials')
                            ->visibility('public')
                            ->maxSize(10240)
                            ->nullable()
                            ->helperText(
                                'Optional. Upload JPG, PNG or WebP up to 10 MB.'
                            ),
                    ])
                    ->columns(2),

                Section::make('Client Feedback')
                    ->schema([
                        Textarea::make('feedback')
                            ->label('Feedback')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'Please enter the client feedback.',
                            ]),

                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->default(5)
                            ->required(),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Show on Website')
                            ->helperText(
                                'Disable this to hide the testimonial.'
                            )
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }
}