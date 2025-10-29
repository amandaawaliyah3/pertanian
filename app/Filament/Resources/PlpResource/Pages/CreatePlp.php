<?php

namespace App\Filament\Resources\PlpResource\Pages;

use App\Filament\Resources\PlpResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlp extends CreateRecord
{
    protected static string $resource = PlpResource::class;

    // ✅ HOOK: Mengarahkan pengguna ke halaman 'index' (List PLPs) setelah Create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}