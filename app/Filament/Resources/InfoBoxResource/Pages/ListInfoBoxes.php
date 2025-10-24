<?php

namespace App\Filament\Resources\InfoBoxResource\Pages;

use App\Filament\Resources\InfoBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfoBoxes extends ListRecords
{
    protected static string $resource = InfoBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
