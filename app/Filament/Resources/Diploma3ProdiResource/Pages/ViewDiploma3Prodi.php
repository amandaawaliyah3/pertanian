<?php

namespace App\Filament\Resources\Diploma3ProdiResource\Pages;

use App\Filament\Resources\Diploma3ProdiResource;
use Filament\Resources\Pages\ViewRecord;

class ViewDiploma3Prodi extends ViewRecord
{
    protected static string $resource = Diploma3ProdiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
