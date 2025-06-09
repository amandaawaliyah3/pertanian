<?php

namespace App\Filament\Resources\Diploma3ProdiResource\Pages;

use App\Filament\Resources\Diploma3ProdiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiploma3Prodis extends ListRecords
{
    protected static string $resource = Diploma3ProdiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
