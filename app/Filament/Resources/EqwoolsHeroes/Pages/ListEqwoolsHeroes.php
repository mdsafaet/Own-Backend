<?php

namespace App\Filament\Resources\EqwoolsHeroes\Pages;

use App\Filament\Resources\EqwoolsHeroes\EqwoolsHeroResource;
use App\Models\EqwoolsHero;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEqwoolsHeroes extends ListRecords
{
    protected static string $resource =
        EqwoolsHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(
                    fn (): bool =>
                        ! EqwoolsHero::query()
                            ->exists()
                ),
        ];
    }
}