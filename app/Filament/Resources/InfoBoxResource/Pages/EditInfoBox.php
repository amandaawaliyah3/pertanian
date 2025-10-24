<?php

namespace App\Filament\Resources\InfoBoxResource\Pages;

use App\Filament\Resources\InfoBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoBox extends EditRecord
{
    protected static string $resource = InfoBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
