<?php

namespace App\Filament\Resources\KerjasamaResource\Pages;

use App\Filament\Resources\KerjasamaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKerjasama extends CreateRecord
{
    protected static string $resource = KerjasamaResource::class;

    // FIX LOGO NULL: Hook ini memaksa path logo dipertahankan saat save
    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->before(function (\Filament\Actions\Action $action, array $data) {
                // Jika path file ada (berupa string setelah upload)
                if (isset($data['logo']) && is_string($data['logo'])) {
                    // Secara eksplisit set data 'logo' pada form state (workaround bug state)
                    $this->data['logo'] = $data['logo'];
                } else {
                    $this->data['logo'] = null;
                }
            });
    }
    // FIX REDIRECT: Mengarahkan kembali ke halaman List setelah create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}