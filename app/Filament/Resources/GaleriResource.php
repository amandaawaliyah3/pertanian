<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Galeri';
    protected static ?string $navigationGroup = 'PERTANIAN';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Galeri')
                    // Menggunakan array statis yang bersih
                    ->schema([
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->directory('galeri')
                            ->required()
                            ->columnSpanFull()
                            
                            // ❌ HAPUS HOOK mutateDehydratedState untuk mencegah TypeError
                            ->nullable(fn (string $operation): bool => $operation === 'edit'), 
                            // *Logika delete saat update harus dipindahkan ke Model Galeri*
                            
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('kategori')
                            ->options([
                                'seminar' => 'Seminar',
                                'lomba' => 'Lomba',
                                'praktikum' => 'Praktikum',
                                'sosialisasi' => 'Sosialisasi',
                                'workshop' => 'Workshop',
                                'lainnya' => 'Lainnya',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->required(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto') 
                    ->label('Foto')
                    ->disk('public'), 
                
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'seminar' => 'Seminar',
                        'lomba' => 'Lomba',
                        'praktikum' => 'Praktikum',
                        'sosialisasi' => 'Sosialisasi',
                        'workshop' => 'Workshop',
                        'lainnya' => 'Lainnya',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // ✅ Hooks Delete (ini harus tetap ada karena tidak menyebabkan TypeError)
                Tables\Actions\DeleteAction::make()
                    ->before(function (Galeri $record) {
                        if ($record->foto) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (\Illuminate\Support\Collection $records) {
                            $records->each(function (Galeri $record) {
                                if ($record->foto) {
                                    Storage::disk('public')->delete($record->foto);
                                }
                            });
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}