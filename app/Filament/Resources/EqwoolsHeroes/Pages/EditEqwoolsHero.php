<?php

namespace App\Filament\Resources\EqwoolsHeroes\Pages;

use App\Filament\Resources\EqwoolsHeroes\EqwoolsHeroResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEqwoolsHero extends EditRecord
{
    protected static string $resource = EqwoolsHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
