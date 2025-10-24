<?php

namespace App\Filament\Resources\KerjasamaResource\Pages;

use App\Filament\Resources\KerjasamaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditKerjasama extends EditRecord
{
    protected static string $resource = KerjasamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // ✅ FIX REDIRECT: Mengarahkan kembali ke halaman list setelah update
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // FIX DELETE: Hook untuk menghapus file lama saat Save (Update)
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldRecord = $this->getRecord();
        
        // Cek apakah kolom 'logo' telah diubah DAN path yang tersimpan di DB tidak kosong
        if (isset($data['logo']) && $oldRecord->logo && $oldRecord->logo !== $data['logo']) {
            // Hapus file lama dari storage
            Storage::disk('public')->delete($oldRecord->logo);
        }

        return $data;
    }
}