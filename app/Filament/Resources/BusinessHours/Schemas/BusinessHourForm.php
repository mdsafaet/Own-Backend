<?php

namespace App\Filament\Resources\BusinessHours\Schemas;


use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class BusinessHourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Business Hours Section')
                    ->description(
                        'Manage the business hours information displayed on the contact page.'
                    )
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Small Heading')
                            ->placeholder('Business Hours')
                            ->maxLength(100),

                        TextInput::make('working_days')
                            ->label('Working Days')
                            ->placeholder('Monday – Friday')
                            ->maxLength(150),

                        TextInput::make('working_hours')
                            ->label('Working Hours')
                            ->placeholder('09:00 AM – 06:00 PM')
                            ->maxLength(150),

                        TextInput::make('timezone')
                            ->label('Timezone')
                            ->placeholder('Bangladesh Time')
                            ->maxLength(100),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+880 1726-339903')
                            ->maxLength(50),

                        TextInput::make('button_text')
                            ->label('Button Text')
                            ->placeholder('Call Our Team')
                            ->maxLength(100),

                        Toggle::make('is_active')
                            ->label('Show this section on the website')
                            ->helperText(
                                'Disable this option to hide the business hours section.'
                            )
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}