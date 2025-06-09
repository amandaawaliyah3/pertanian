<?php

namespace App\Filament\Resources\JalurMasukResource\Pages;

use App\Filament\Resources\JalurMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJalurMasuk extends ViewRecord
{
    protected static string $resource = JalurMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Jalur Masuk')
                ->icon('heroicon-o-pencil-square'),

            Actions\DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash'),

            Actions\Action::make('kembali')
                ->label('Kembali ke Daftar')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-arrow-left'),
        ];
    }
}
