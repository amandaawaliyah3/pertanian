<?php

namespace App\Filament\Resources\AdministrasiPertanianResource\Pages;

use App\Filament\Resources\AdministrasiPertanianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class EditAdministrasiPertanian extends EditRecord
{
    protected static string $resource = AdministrasiPertanianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // ✅ HOOK UNTUK MENGHAPUS FOTO LAMA SAAT SAVE/UPDATE
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldRecord = $this->getRecord();
        
        // Cek apakah kolom 'foto' telah diubah DAN path lama tidak kosong
        if (isset($data['foto']) && $oldRecord->foto && $oldRecord->foto !== $data['foto']) {
            // Hapus file lama dari storage
            Storage::disk('public')->delete($oldRecord->foto);
        }

        return $data;
    }
    
    // Opsional: Redirect ke halaman list setelah edit
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}