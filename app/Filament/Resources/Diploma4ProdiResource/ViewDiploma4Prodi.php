<?php

namespace App\Filament\Resources\Diploma4ProdiResource\Pages;

use App\Filament\Resources\Diploma4ProdiResource;
use Filament\Resources\Pages\ViewRecord;

class ViewDiploma4Prodi extends ViewRecord
{
    protected static string $resource = Diploma4ProdiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
