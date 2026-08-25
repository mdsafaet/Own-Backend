<?php

namespace App\Filament\Resources\ShowroomProducts\Pages;

use App\Filament\Resources\ShowroomProducts\ShowroomProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShowroomProduct extends CreateRecord
{
    protected static string $resource =
        ShowroomProductResource::class;
}