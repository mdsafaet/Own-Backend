<?php

namespace App\Filament\Resources\NewsArticles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsArticleForm
{
    public static function configure(
        Schema $schema
    ): Schema {
        return $schema
            ->components([
                Section::make('Article Information')
                    ->description(
                        'Create an internal article or share an external newspaper article.'
                    )
                    ->schema([
                        TextInput::make('title')
                            ->label('Article Title')
                            ->required()
                            ->maxLength(250)
                            ->validationMessages([
                                'required' =>
                                    'Please enter the article title.',
                            ]),

                        Select::make('content_type')
                            ->label('Article Type')
                            ->options([
                                'internal' =>
                                    'Internal Article',

                                'external' =>
                                    'External Newspaper Link',
                            ])
                            ->default('internal')
                            ->required()
                            ->live()
                            ->validationMessages([
                                'required' =>
                                    'Please select the article type.',
                            ]),

                        TextInput::make('category')
                            ->label('Category')
                            ->placeholder(
                                'Example: Company News'
                            )
                            ->nullable()
                            ->maxLength(100),

                        TextInput::make('author')
                            ->label('Author')
                            ->placeholder(
                                'Own Sourcing International'
                            )
                            ->nullable()
                            ->maxLength(150),

                        TextInput::make('source_name')
                            ->label(
                                'External Source Name'
                            )
                            ->placeholder(
                                'Example: The Daily Star'
                            )
                            ->helperText(
                                'Complete this field when sharing an external newspaper article.'
                            )
                            ->nullable()
                            ->maxLength(150),

                        TextInput::make('external_url')
                            ->label(
                                'External Article URL'
                            )
                            ->placeholder(
                                'https://example.com/article'
                            )
                            ->url()
                            ->requiredIf(
                                'content_type',
                                'external'
                            )
                            ->nullable()
                            ->maxLength(1000)
                            ->helperText(
                                'Required for external articles.'
                            )
                            ->validationMessages([
                                'required_if' =>
                                    'Please enter the external article URL.',

                                'url' =>
                                    'Please enter a valid URL starting with http:// or https://.',
                            ]),

                        TextInput::make('read_time')
                            ->label('Reading Time')
                            ->placeholder(
                                'Example: 5 min read'
                            )
                            ->nullable()
                            ->maxLength(50),

                        Textarea::make('excerpt')
                            ->label('Short Excerpt')
                            ->placeholder(
                                'Short introduction displayed on the news card.'
                            )
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Featured Image')
                            ->image()
                            ->disk('public')
                            ->directory(
                                'news-articles'
                            )
                            ->visibility('public')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->maxSize(5120)
                            ->helperText(
                                'JPG, PNG or WebP. Maximum size: 5MB.'
                            )
                            ->nullable()
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label(
                                'Full Article Content'
                            )
                            ->helperText(
                                'Write the full content for internal articles. External articles can leave this empty.'
                            )
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Publishing Settings')
                    ->description(
                        'Control when and where the article appears.'
                    )
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',

                                'published' =>
                                    'Published',
                            ])
                            ->default('draft')
                            ->required()
                            ->validationMessages([
                                'required' =>
                                    'Please select the publication status.',
                            ]),

                        DateTimePicker::make(
                            'published_at'
                        )
                            ->label('Publish Date')
                            ->native(false)
                            ->seconds(false)
                            ->helperText(
                                'If left empty when published, the current date and time will be used.'
                            )
                            ->nullable(),

                        Toggle::make('featured')
                            ->label(
                                'Feature on Home Page'
                            )
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required()
                            ->validationMessages([
                                'required' =>
                                    'Please enter the display order.',

                                'numeric' =>
                                    'Display order must be a number.',

                                'min' =>
                                    'Display order cannot be negative.',
                            ]),
                    ])
                    ->columns(4),
            ]);
    }
}