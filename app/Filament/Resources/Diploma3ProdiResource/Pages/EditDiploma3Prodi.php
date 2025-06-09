<?php

namespace App\Filament\Resources\Diploma3ProdiResource\Pages;

use App\Filament\Resources\Diploma3ProdiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiploma3Prodi extends EditRecord
{
    protected static string $resource = Diploma3ProdiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
