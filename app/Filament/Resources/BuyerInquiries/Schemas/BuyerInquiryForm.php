<?php

namespace App\Filament\Resources\BuyerInquiries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BuyerInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Buyer Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Company Name')
                            ->disabled(),

                        TextInput::make('contact_person')
                            ->label('Contact Person')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->disabled(),

                        TextInput::make('country')
                            ->disabled(),
                    ]),

                Section::make('Commercial Requirements')
                    ->columns(2)
                    ->schema([
                        TextInput::make('product_code')
                            ->label('Product Code')
                            ->disabled(),

                        TextInput::make('estimated_quantity')
                            ->label('Estimated Quantity')
                            ->disabled(),

                        TextInput::make('target_price')
                            ->label('Target Price')
                            ->disabled(),

                        TextInput::make('target_delivery_date')
                            ->label('Target Delivery Date')
                            ->disabled(),

                        FileUpload::make('attachment')
                            ->label('Tech Pack or Reference File')
                            ->disk('public')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->disabled()
                            ->columnSpanFull(),

                        Textarea::make('message')
                            ->rows(6)
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                Section::make('Inquiry Management')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'reviewing' => 'Reviewing',
                                'contacted' => 'Contacted',
                                'quoted' => 'Quotation Sent',
                                'closed' => 'Closed',
                                'spam' => 'Spam',
                            ]),

                        TextInput::make('contacted_at')
                            ->label('Contacted At')
                            ->disabled(),

                        Textarea::make('internal_notes')
                            ->label('Internal Notes')
                            ->rows(5)
                            ->placeholder(
                                'Add private notes for the sourcing team.'
                            )
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}