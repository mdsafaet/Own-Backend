<?php

namespace App\Filament\Resources\BuyerInquiries;

use App\Filament\Resources\BuyerInquiries\Pages\EditBuyerInquiry;
use App\Filament\Resources\BuyerInquiries\Pages\ListBuyerInquiries;
use App\Filament\Resources\BuyerInquiries\Schemas\BuyerInquiryForm;
use App\Filament\Resources\BuyerInquiries\Tables\BuyerInquiriesTable;
use App\Models\BuyerInquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BuyerInquiryResource extends Resource
{
    protected static ?string $model =
        BuyerInquiry::class;

    protected static string|BackedEnum|null
        $navigationIcon =
            Heroicon::OutlinedInbox;

    protected static string|UnitEnum|null
        $navigationGroup =
            'Innovation Hub';

    protected static ?string $navigationLabel =
        'Buyer Inquiries';

    protected static ?string $modelLabel =
        'Buyer Inquiry';

    protected static ?string $pluralModelLabel =
        'Buyer Inquiries';

    protected static ?int $navigationSort = 2;

    public static function form(
        Schema $schema
    ): Schema {
        return BuyerInquiryForm::configure(
            $schema
        );
    }

    public static function table(
        Table $table
    ): Table {
        return BuyerInquiriesTable::configure(
            $table
        );
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::query()
            ->where('status', 'new')
            ->count();

        return $count > 0
            ? (string) $count
            : null;
    }

    public static function getNavigationBadgeColor():
        string|array|null
    {
        return 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' =>
                ListBuyerInquiries::route('/'),

            'edit' =>
                EditBuyerInquiry::route(
                    '/{record}/edit'
                ),
        ];
    }
}