<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Diploma4ProdiResource\Pages;
use App\Filament\Resources\Diploma4ProdiResource\RelationManagers;
use App\Models\Diploma4Prodi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Diploma4ProdiResource extends Resource
{
    protected static ?string $model = Diploma4Prodi::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Diploma 4';
    protected static ?string $modelLabel = 'Program Studi D4';
    protected static ?string $navigationGroup = 'INFORMASI';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_prodi')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Program Studi'),

                Forms\Components\TextInput::make('masa_kuliah')
                    ->required()
                    ->maxLength(255)
                    ->label('Masa Kuliah'),

                Forms\Components\Textarea::make('visi')
                    ->required()
                    ->columnSpanFull()
                    ->label('Visi'),

                Forms\Components\Textarea::make('misi')
                    ->required()
                    ->columnSpanFull()
                    ->label('Misi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nama_prodi')
                    ->searchable()
                    ->sortable()
                    ->label('Program Studi'),

                Tables\Columns\TextColumn::make('masa_kuliah')
                    ->searchable()
                    ->label('Durasi'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada Program Studi D4')
            ->emptyStateDescription('Klik tombol dibawah untuk membuat Program Studi D4 pertama')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Program Studi D4')
                    ->icon('heroicon-o-plus'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiploma4Prodis::route('/'),
            'create' => Pages\CreateDiploma4Prodi::route('/create'),
            'view' => Pages\ViewDiploma4Prodi::route('/{record}'),
            'edit' => Pages\EditDiploma4Prodi::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
