<?php

namespace App\Filament\Resources\PlpResource\Pages;

use App\Filament\Resources\PlpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlp extends EditRecord
{
    protected static string $resource = PlpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
