<?php

namespace App\Filament\Resources\FooterSettingResource\Pages;

use App\Filament\Resources\FooterSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooterSetting extends EditRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function () {
                    // Cegah penghapusan jika ini satu-satunya record
                    if ($this->record->id === 1) {
                        $this->notify('danger', 'Tidak dapat menghapus pengaturan footer utama');
                        return false;
                    }
                }),
        ];
    }
}