<?php

namespace App\Filament\Resources\AdministrasiPertanianResource\Pages;

use App\Filament\Resources\AdministrasiPertanianResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdministrasiPertanian extends CreateRecord
{
    protected static string $resource = AdministrasiPertanianResource::class;

    // ✅ HOOK: Mengarahkan pengguna ke halaman 'index' (List Administrasi) setelah Create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}