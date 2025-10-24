<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteLogoResource\Pages\EditSiteLogo;
use App\Models\SiteLogo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SiteLogoResource extends Resource
{
    protected static ?string $model = SiteLogo::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Logo Website';
    protected static ?string $navigationLabel = 'Pengaturan Logo';
    protected static ?string $navigationGroup = 'PENGATURAN';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pengaturan Logo')
                ->schema([
                    Forms\Components\FileUpload::make('logo_path')
                        ->label('Logo')
                        ->directory('site/logos')
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048)
                        ->required(), // Tetap required untuk save

                    Forms\Components\TextInput::make('institution_name')
                        ->label('Nama Institusi')
                        ->required(),

                    Forms\Components\TextInput::make('institution_subname')
                        ->label('Deskripsi Institusi')
                        ->required()
                ])
        ]);
    }

    // ✅ HOOK YANG DIBUTUHKAN UNTUK MENGHAPUS FILE LAMA SAAT UPDATE
    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Karena ini adalah single resource, kita bisa mencari record yang ada (ID 1 atau ID yang sedang diedit)
        $oldRecord = static::getModel()::find(request('record')); 

        if ($oldRecord) {
            // Cek apakah logo_path di form berbeda dari yang ada di database
            // Ini menangani kasus replace (data['logo_path'] = path baru) atau reset (data['logo_path'] = null)
            if ($oldRecord->logo_path && $oldRecord->logo_path !== $data['logo_path']) {
                Storage::disk('public')->delete($oldRecord->logo_path);
            }
        }
        
        // Hapus file lama jika kolom di-reset, tapi FileUpload-nya required,
        // (Filament seharusnya tidak mengizinkan save jika required dan nilainya null, 
        // tapi kita pastikan logikanya ada untuk clean-up)
        elseif ($data['logo_path'] === null && $oldRecord && $oldRecord->logo_path) {
            Storage::disk('public')->delete($oldRecord->logo_path);
        }

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('institution_name')
                    ->label('Nama Institusi'),

                Tables\Columns\TextColumn::make('institution_subname')
                    ->label('Deskripsi')
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => EditSiteLogo::route('/'),
        ];
    }
}