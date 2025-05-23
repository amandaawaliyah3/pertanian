<?php

namespace App\Filament\Resources\FooterSettingResource\Pages;

use App\Filament\Resources\FooterSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFooterSetting extends CreateRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function beforeCreate(): void
    {
        // Cegah pembuatan baru jika sudah ada record
        if (\App\Models\FooterSetting::exists()) {
            $this->notify('danger', 'Hanya boleh ada satu pengaturan footer');
            $this->halt();
        }
    }
}