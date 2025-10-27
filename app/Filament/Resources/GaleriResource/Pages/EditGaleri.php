<?php

namespace App\Filament\Resources\GaleriResource\Pages;

use App\Filament\Resources\GaleriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class EditGaleri extends EditRecord
{
    protected static string $resource = GaleriResource::class;

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
        
        // Cek apakah kolom 'foto' diubah DAN path lama tidak kosong
        if (isset($data['foto']) && $oldRecord->foto && $oldRecord->foto !== $data['foto']) {
            // Hapus file lama dari storage
            Storage::disk('public')->delete($oldRecord->foto);
        }

        return $data;
    }
}