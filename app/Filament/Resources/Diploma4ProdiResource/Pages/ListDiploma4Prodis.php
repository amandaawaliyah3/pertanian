<?php

namespace App\Filament\Resources\Diploma4ProdiResource\Pages;

use App\Filament\Resources\Diploma4ProdiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiploma4Prodis extends ListRecords
{
    protected static string $resource = Diploma4ProdiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
