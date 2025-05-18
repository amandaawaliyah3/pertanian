<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $modelLabel = 'Fasilitas';
    protected static ?string $navigationGroup = 'Profil Prodi';
    protected static ?string $navigationLabel = 'Manajemen Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto Fasilitas')
                    ->image()
                    ->directory('fasilitas')
                    ->required()
                    ->maxSize(1024)
                    ->columnSpanFull(),
                    
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Fasilitas')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\Select::make('jenis')
                    ->label('Jenis Fasilitas')
                    ->options(Fasilitas::JENIS)
                    ->required(),
                    
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->height(60)
                    ->width(60)
                    ->square(),
                    
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'laboratorium' => 'info',
                        'greenhouse' => 'success',
                        'lahan_praktikum' => 'warning',
                        'ruang_kelas' => 'primary',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->options(Fasilitas::JENIS)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Fasilitas $record) {
                        Storage::disk('public')->delete($record->foto);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                Storage::disk('public')->delete($record->foto);
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}