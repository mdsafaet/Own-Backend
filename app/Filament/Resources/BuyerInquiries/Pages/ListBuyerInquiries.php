<?php

namespace App\Filament\Resources\BuyerInquiries\Pages;

use App\Filament\Resources\BuyerInquiries\BuyerInquiryResource;
use Filament\Resources\Pages\ListRecords;

class ListBuyerInquiries extends ListRecords
{
    protected static string $resource =
        BuyerInquiryResource::class;
}