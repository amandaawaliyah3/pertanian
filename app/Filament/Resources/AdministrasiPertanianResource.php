<?php

namespace App\Filament\Resources;

use App\Models\AdministrasiPertanian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Filament\Resources\AdministrasiPertanianResource\Pages\CreateAdministrasiPertanian;
use App\Filament\Resources\AdministrasiPertanianResource\Pages\EditAdministrasiPertanian;
use App\Filament\Resources\AdministrasiPertanianResource\Pages\ListAdministrasiPertanians;

class AdministrasiPertanianResource extends Resource
{
    protected static ?string $model = AdministrasiPertanian::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Administrasi';
    protected static ?string $navigationGroup = 'PERTANIAN';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Staf')
                    ->schema([
                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('foto-administrasi')
                            
                            // Menggunakan UUID untuk penamaan file yang unik dan aman
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) Str::uuid().'.'.$file->extension()
                            )
                            ->columnSpanFull()
                            
                            // Di sini dihapus hooks delete yang menyebabkan Type Error
                            ->nullable(fn (string $operation): bool => $operation === 'edit'), 

                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('bidang')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),

                Tables\Columns\TextColumn::make('bidang')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // Hapus foto saat Single Delete
                Tables\Actions\DeleteAction::make()
                    ->before(function (AdministrasiPertanian $record) {
                        if ($record->foto) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Hapus foto saat Bulk Delete
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (\Illuminate\Support\Collection $records) {
                            $records->each(function (AdministrasiPertanian $record) {
                                if ($record->foto) {
                                    Storage::disk('public')->delete($record->foto);
                                }
                            });
                        }),
                ]),
            ])
            // ✅ FIX: Hapus tombol create dari empty state dengan array kosong
            ->emptyStateActions([
                // Hapus baris ini: Tables\Actions\CreateAction::make(),
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
            'index' => ListAdministrasiPertanians::route('/'),
            'create' => CreateAdministrasiPertanian::route('/create'),
            'edit' => EditAdministrasiPertanian::route('/{record}/edit'),
        ];
    }
}