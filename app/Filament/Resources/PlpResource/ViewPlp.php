<?php

namespace App\Filament\Resources\PlpResource\Pages;

use App\Filament\Resources\PlpResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlp extends ViewRecord
{
    protected static string $resource = PlpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
