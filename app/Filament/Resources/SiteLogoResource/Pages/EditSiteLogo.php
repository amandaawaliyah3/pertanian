<?php

namespace App\Filament\Resources\SiteLogoResource\Pages;

use App\Filament\Resources\SiteLogoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\SiteLogo;
use Illuminate\Support\Facades\Storage;

class EditSiteLogo extends EditRecord
{
    protected static string $resource = SiteLogoResource::class;

    /**
     * Override mount method to bypass dependency resolution
     */
    public function mount(int|string $record = null): void
    {
        // Force load our single record
        $this->record = SiteLogo::firstOrCreate(
            ['id' => 1],
            [
                'logo_path' => null,
                'institution_name' => 'Jurusan Pertanian',
                'institution_subname' => 'Politeknik Pertanian Negeri Samarinda',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $this->fillForm();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Reset Logo')
                ->action(function (SiteLogo $record) {
                    if ($record->logo_path) {
                        Storage::disk('public')->delete($record->logo_path);
                    }
                    $record->update([
                        'logo_path' => null,
                        'institution_name' => 'Jurusan Pertanian',
                        'institution_subname' => 'Politeknik Pertanian Negeri Samarinda'
                    ]);
                    $this->form->fill($record->fresh()->toArray());
                })
                ->color('danger')
                ->requiresConfirmation(),
        ];
    }

    /**
     * Bypass standard record resolution
     */
    protected function resolveRecord(int|string $key): SiteLogo
    {
        return $this->record;
    }
}
