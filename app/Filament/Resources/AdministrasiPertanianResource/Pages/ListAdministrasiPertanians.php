<?php

namespace App\Filament\Resources\AdministrasiPertanianResource\Pages;

use App\Filament\Resources\AdministrasiPertanianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdministrasiPertanians extends ListRecords
{
    protected static string $resource = AdministrasiPertanianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
