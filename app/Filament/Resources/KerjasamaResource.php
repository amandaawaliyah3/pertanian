<?php

namespace App\Filament\Resources;

use App\Models\Kerjasama;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\KerjasamaResource\Pages;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class KerjasamaResource extends Resource
{
    protected static ?string $model = Kerjasama::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'MITRA';
    protected static ?string $navigationLabel = 'Kerja sama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Kerja sama')
                ->schema([
                    tap(FileUpload::make('logo'), function (FileUpload $fileUpload) {
                        $fileUpload->image()
                            ->directory('kerjasama-logos')
                            
                            // FIX: Menggunakan penamaan file UUID sederhana (paling stabil)
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) Str::uuid() . '.' . $file->getClientOriginalExtension()
                            )
                            
                            ->imageEditor()
                            ->columnSpanFull()
                            
                            // 1. Izinkan null saat Edit
                            ->nullable(fn (string $operation): bool => $operation === 'edit')
                            
                            // 2. Hook untuk menghapus logo lama saat diganti/di-reset
                            ->mutateDehydratedState(function ($state, $old, $livewire) {
                                if ($livewire instanceof \Filament\Resources\Pages\EditRecord) {
                                    $oldRecord = $livewire->getRecord();
                                    
                                    if ($oldRecord->logo && $oldRecord->logo !== $state) {
                                        Storage::disk('public')->delete($oldRecord->logo);
                                    }
                                }
                                return $state;
                            });
                        return $fileUpload;
                    }),

                    TextInput::make('nama_mitra')
                        ->required(),

                    TextInput::make('jenis_kerjasama')
                        ->required(),

                    DatePicker::make('tanggal_mulai')
                        ->required(),

                    DatePicker::make('tanggal_selesai')
                        ->required(),

                    Textarea::make('keterangan')
                        ->columnSpanFull(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->disk('public') // FIX: Agar logo tampil di tabel
                    ->circular(),

                TextColumn::make('nama_mitra')
                    ->searchable(),

                TextColumn::make('jenis_kerjasama'),

                TextColumn::make('tanggal_mulai')
                    ->date(),

                TextColumn::make('tanggal_selesai')
                    ->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // FIX: Hapus logo saat Single Delete
                Tables\Actions\DeleteAction::make()
                    ->before(function (Kerjasama $record) {
                        if ($record->logo) {
                            Storage::disk('public')->delete($record->logo); 
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // FIX: Hapus logo saat Bulk Delete
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (\Illuminate\Support\Collection $records) {
                            $records->each(function (Kerjasama $record) {
                                if ($record->logo) {
                                    Storage::disk('public')->delete($record->logo);
                                }
                            });
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKerjasamas::route('/'),
            'create' => Pages\CreateKerjasama::route('/create'),
            'edit' => Pages\EditKerjasama::route('/{record}/edit'),
        ];
    }
}