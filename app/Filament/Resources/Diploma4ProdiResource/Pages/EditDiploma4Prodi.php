<?php

namespace App\Filament\Resources\Diploma4ProdiResource\Pages;

use App\Filament\Resources\Diploma4ProdiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiploma4Prodi extends EditRecord
{
    protected static string $resource = Diploma4ProdiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
