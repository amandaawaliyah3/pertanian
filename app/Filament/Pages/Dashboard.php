<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Actions\Action;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('kembali')
                ->label('← Kembali ke Beranda')
                ->url(route('beranda')) // Pastikan kamu punya route 'beranda'
                ->color('gray')
        ];
    }
}
