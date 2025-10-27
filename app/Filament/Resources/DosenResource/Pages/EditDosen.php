<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class EditDosen extends EditRecord
{
    protected static string $resource = DosenResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Data dosen berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($record) {
                    // Hapus foto saat menghapus record (perilaku yang sudah ada)
                    if ($record->foto) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete('dosen/'.$record->foto);
                    }
                }),
        ];
    }

    // ✅ HOOK UNTUK MENGHAPUS FOTO LAMA SAAT SAVE/UPDATE
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldRecord = $this->getRecord();
        
        // Cek apakah kolom 'foto' telah diubah DAN path lama tidak kosong
        // Note: $data['foto'] akan menjadi path baru atau null (jika di-reset)
        if (isset($data['foto']) && $oldRecord->foto && $oldRecord->foto !== $data['foto']) {
            // Hapus file lama dari storage
            Storage::disk('public')->delete($oldRecord->foto);
        }

        return $data;
    }
}