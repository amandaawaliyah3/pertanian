<?php

namespace App\Filament\Resources\FasilitasResource\Pages;

use App\Filament\Resources\FasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditFasilitas extends EditRecord
{
    protected static string $resource = FasilitasResource::class;

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

    // (Hook mutateFormDataBeforeSave lainnya tetap ada di sini)
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldRecord = $this->getRecord();
        
        // Logic delete file lama saat update
        if (isset($data['foto']) && $oldRecord->foto && $oldRecord->foto !== $data['foto']) {
            Storage::disk('public')->delete($oldRecord->foto);
        }

        return $data;
    }
}