<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\DeleteBulkAction;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $modelLabel = 'Prestasi Mahasiswa';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul') // Diubah dari 'nama' ke 'judul'
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Prestasi'),
                Textarea::make('deskripsi') // Diubah dari 'prestasi' ke 'deskripsi'
                    ->required()
                    ->columnSpanFull()
                    ->label('Deskripsi Prestasi'),
                DatePicker::make('tanggal')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false),
                FileUpload::make('gambar')
                    ->image()
                    ->directory('prestasi')
                    ->required()
                    ->label('Foto/Gambar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular(),
                Tables\Columns\TextColumn::make('judul') // Diubah dari 'nama' ke 'judul'
                    ->searchable()
                    ->sortable()
                    ->label('Judul'),
                Tables\Columns\TextColumn::make('deskripsi') // Diubah dari 'prestasi' ke 'deskripsi'
                    ->searchable()
                    ->sortable()
                    ->limit(50) // Membatasi jumlah karakter yang ditampilkan
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        // Menampilkan tooltip jika panjang teks melebihi limit
                        if (strlen($state) > 50) {
                            return $state;
                        }
                        return null;
                    })
                    ->label('Deskripsi'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([ 
                // Filter dapat ditambahkan di sini
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
