<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Filament\Resources\DosenResource\RelationManagers;
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
    protected static ?string $modelLabel = 'Dosen';
    protected static ?string $navigationGroup = 'Akademik';
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
                            ->helperText('Ukuran maksimal 2MB. Format: JPG, PNG')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Dr. John Doe, S.Kom., M.Kom.'),

                        Forms\Components\TextInput::make('nidn')
                            ->label('NIDN')
                            ->required()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: 1234567890'),

                        Forms\Components\TagsInput::make('bidang_keahlian')
                            ->placeholder('Tambahkan bidang keahlian')
                            ->helperText('Tekan Enter setelah menulis setiap bidang keahlian')
                            ->nestedRecursiveRules(['max:100']),
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
                        Forms\Components\Repeater::make('penelitian_publikasi.penelitian')
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
                        Forms\Components\Repeater::make('penelitian_publikasi.publikasi')
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
                            ->placeholder('email@contoh.com'),

                        Forms\Components\TextInput::make('no_hp')
                            ->tel()
                            ->placeholder('081234567890'),
                    ])
                    ->columns(2),

                Forms\Components\Toggle::make('is_kaprodi')
                    ->label('Koordinator Prodi?')
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->getStateUsing(fn ($record) => $record->foto_url)
                    ->circular()
                    ->width(50)
                    ->height(50),
                    
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('nidn')
                    ->label('NIDN')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->searchable()
                    ->limit(25),
                    
                Tables\Columns\TextColumn::make('penelitian_count')
                    ->label('Jml. Penelitian')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('publikasi_count')
                    ->label('Jml. Publikasi')
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
                    ->query(fn (Builder $query): Builder => $query->where('penelitian_publikasi', 'like', '%penelitian%')),
                    
                Tables\Filters\Filter::make('memiliki_publikasi')
                    ->label('Memiliki Publikasi')
                    ->query(fn (Builder $query): Builder => $query->where('penelitian_publikasi', 'like', '%publikasi%')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->before(function ($record) {
                            // Hapus foto saat menghapus record
                            if ($record->foto) {
                                Storage::disk('public')->delete('dosen/'.$record->foto);
                            }
                        })
                        ->successNotificationTitle('Dosen berhasil dihapus'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Hapus semua foto dosen yang dipilih
                            foreach ($records as $record) {
                                if ($record->foto) {
                                    Storage::disk('public')->delete('dosen/'.$record->foto);
                                }
                            }
                        })
                        ->successNotificationTitle('Dosen terpilih berhasil dihapus'),
                        
                    Tables\Actions\BulkAction::make('set_kaprodi')
                        ->label('Set sebagai Kaprodi')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records) {
                            // Nonaktifkan semua kaprodi terlebih dahulu
                            Dosen::where('is_kaprodi', true)->update(['is_kaprodi' => false]);
                            // Aktifkan yang dipilih
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
        return [
            // Relation managers bisa ditambahkan di sini jika diperlukan
        ];
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