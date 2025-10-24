<?php

namespace App\Filament\Resources\AdministrasiPertanianResource\Pages;

use App\Filament\Resources\AdministrasiPertanianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdministrasiPertanian extends EditRecord
{
    protected static string $resource = AdministrasiPertanianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
