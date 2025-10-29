<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Models\Dosen;
use App\Models\Prodi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage; // Pastikan ini di-import

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Data Akademik';
    protected static ?string $navigationLabel = 'Dosen';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama_dosen')
                ->label('Nama Dosen')
                ->required(),

            TextInput::make('nip')
                ->label('NIP')
                ->required(),

            TextInput::make('jabatan')
                ->label('Jabatan')
                ->nullable(),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->nullable(),

            Select::make('prodi_id')
                ->label('Program Studi')
                ->relationship('prodi', 'nama_prodi')
                ->searchable()
                ->preload()
                ->required(),

            // FileUpload tanpa hook yang menyebabkan TypeError (Logic delete saat update ada di EditDosen.php)
            FileUpload::make('foto')
                ->label('Foto Dosen')
                ->directory('dosen')
                ->image()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public') // Pastikan disk public untuk tampilan
                    ->square()
                    ->size(50),

                TextColumn::make('nama_dosen')->searchable(),
                TextColumn::make('nip')->label('NIP'),
                TextColumn::make('jabatan')->label('Jabatan'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('prodi.nama_prodi')->label('Prodi')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // Hook untuk menghapus file saat Single Delete
                Tables\Actions\DeleteAction::make()
                    ->before(function (\App\Models\Dosen $record) {
                        if ($record->foto) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Hook untuk menghapus file saat Bulk Delete
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (\Illuminate\Support\Collection $records) {
                            $records->each(function (\App\Models\Dosen $record) {
                                if ($record->foto) {
                                    Storage::disk('public')->delete($record->foto);
                                }
                            });
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}