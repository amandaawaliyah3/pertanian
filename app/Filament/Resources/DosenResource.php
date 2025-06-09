<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Models\Dosen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $modelLabel = 'Data Dosen';
    protected static ?string $navigationGroup = 'PERTANIAN';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('dosen')
                            ->disk('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->helperText('Ukuran maksimal 2MB. Format: JPG, PNG')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Dr. John Doe, S.Kom., M.Kom.'),

                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: 1234567890'),

                        Forms\Components\Textarea::make('bidang_keahlian')
                            ->label('Bidang Keahlian')
                            ->placeholder('Masukkan bidang keahlian, dipisahkan dengan koma')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Riwayat Pendidikan & Pengalaman')
                    ->schema([
                        Forms\Components\Textarea::make('riwayat_pendidikan')
                            ->label('Riwayat Pendidikan')
                            ->placeholder("Contoh:\nS1 Teknik Informatika - Universitas X (2010)\nS2 Ilmu Komputer - Universitas Y (2015)")
                            ->helperText('Satu pendidikan per baris')
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('pengalaman_kerja')
                            ->label('Pengalaman Kerja')
                            ->placeholder("Contoh:\nDosen Universitas X (2015-sekarang)\nSoftware Engineer PT Y (2010-2015)")
                            ->helperText('Satu pengalaman per baris')
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Penelitian')
                    ->schema([
                        Forms\Components\Repeater::make('penelitian')
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->required()
                                    ->placeholder('Judul Penelitian')
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('tahun')
                                    ->numeric()
                                    ->minValue(2000)
                                    ->maxValue(now()->year)
                                    ->placeholder('Tahun')
                                    ->required(),

                                Forms\Components\TextInput::make('sumber_dana')
                                    ->placeholder('Sumber Dana'),

                                Forms\Components\TextInput::make('jumlah_dana')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->placeholder('Jumlah Dana'),

                                Forms\Components\Textarea::make('deskripsi')
                                    ->placeholder('Deskripsi singkat penelitian')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['judul'] ?? 'Penelitian Baru')
                            ->addActionLabel('Tambah Penelitian')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Publikasi')
                    ->schema([
                        Forms\Components\Repeater::make('publikasi')
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->required()
                                    ->placeholder('Judul Publikasi')
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('tahun')
                                    ->numeric()
                                    ->minValue(2000)
                                    ->maxValue(now()->year)
                                    ->placeholder('Tahun')
                                    ->required(),

                                Forms\Components\Select::make('jenis')
                                    ->options([
                                        'jurnal' => 'Jurnal',
                                        'prosiding' => 'Prosiding',
                                        'buku' => 'Buku',
                                        'lainnya' => 'Lainnya'
                                    ])
                                    ->default('jurnal')
                                    ->placeholder('Jenis Publikasi'),

                                Forms\Components\TextInput::make('penerbit')
                                    ->placeholder('Nama Penerbit'),

                                Forms\Components\TextInput::make('link')
                                    ->url()
                                    ->placeholder('https://contoh.com'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['judul'] ?? 'Publikasi Baru')
                            ->addActionLabel('Tambah Publikasi')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('email@contoh.com'),

                        Forms\Components\TextInput::make('no_hp')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('081234567890'),
                    ])
                    ->columns(2),

                Forms\Components\Toggle::make('is_kajur')
                    ->label('Koordinator Jurusan?')
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->width(50)
                    ->height(50),

                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),

                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->searchable()
                    ->limit(25),

                Tables\Columns\TextColumn::make('penelitian_count')
                    ->label('Jml. Penelitian')
                    ->getStateUsing(fn ($record) => count($record->penelitian ?? []))
                    ->sortable(),

                Tables\Columns\TextColumn::make('publikasi_count')
                    ->label('Jml. Publikasi')
                    ->getStateUsing(fn ($record) => count($record->publikasi ?? []))
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_kaprodi')
                    ->label('Kaprodi')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_kaprodi')
                    ->label('Status Kaprodi')
                    ->options([
                        true => 'Kaprodi',
                        false => 'Dosen Biasa',
                    ]),

                Tables\Filters\Filter::make('memiliki_penelitian')
                    ->label('Memiliki Penelitian')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('penelitian')),

                Tables\Filters\Filter::make('memiliki_publikasi')
                    ->label('Memiliki Publikasi')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('publikasi')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->before(function ($record) {
                            if ($record->foto) {
                                Storage::disk('public')->delete('dosen/' . $record->foto);
                            }
                        })
                        ->successNotificationTitle('Dosen berhasil dihapus'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->foto) {
                                    Storage::disk('public')->delete('dosen/' . $record->foto);
                                }
                            }
                        })
                        ->successNotificationTitle('Dosen terpilih berhasil dihapus'),

                    Tables\Actions\BulkAction::make('set_kaprodi')
                        ->label('Set sebagai Kaprodi')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records) {
                            Dosen::where('is_kaprodi', true)->update(['is_kaprodi' => false]);
                            $records->each->update(['is_kaprodi' => true]);
                        })
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->modalHeading('Set Kaprodi')
                        ->modalDescription('Apakah Anda yakin ingin menjadikan dosen terpilih sebagai Kaprodi? Dosen Kaprodi sebelumnya akan dinonaktifkan.')
                        ->modalSubmitActionLabel('Ya, Set sebagai Kaprodi'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'view' => Pages\ViewDosen::route('/{record}'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}
