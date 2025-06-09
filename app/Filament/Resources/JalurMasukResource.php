<?php

namespace App\Filament\Resources;

use App\Models\JalurMasuk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\JalurMasukResource\Pages;
use Illuminate\Database\Eloquent\Builder;

class JalurMasukResource extends Resource
{
    protected static ?string $model = JalurMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'INFORMASI';
    protected static ?string $modelLabel = 'Jalur Masuk';
    protected static ?string $navigationLabel = 'Jalur Masuk';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_jalur')
                ->required()
                ->maxLength(255)
                ->label('Nama Jalur'),

            Forms\Components\Textarea::make('deskripsi')
                ->required()
                ->columnSpanFull()
                ->label('Deskripsi Jalur'),

            Forms\Components\DatePicker::make('tanggal_buka')
                ->required()
                ->label('Tanggal Buka'),

            Forms\Components\DatePicker::make('tanggal_tutup')
                ->required()
                ->label('Tanggal Tutup')
                ->afterOrEqual('tanggal_buka'),

            Forms\Components\TextInput::make('kuota')
                ->required()
                ->numeric()
                ->minValue(1)
                ->label('Kuota Mahasiswa'),

            Forms\Components\Toggle::make('aktif')
                ->label('Status Aktif')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama_jalur')
                ->searchable()
                ->label('Nama Jalur'),

            Tables\Columns\TextColumn::make('tanggal_buka')
                ->date()
                ->label('Tanggal Buka'),

            Tables\Columns\TextColumn::make('tanggal_tutup')
                ->date()
                ->label('Tanggal Tutup'),

            Tables\Columns\TextColumn::make('kuota')
                ->numeric()
                ->label('Kuota'),

            Tables\Columns\IconColumn::make('aktif')
                ->boolean()
                ->label('Aktif'),
        ])
        ->filters([
            Tables\Filters\Filter::make('aktif')
                ->label('Hanya yang aktif')
                ->query(fn (Builder $query) => $query->where('aktif', true)),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(), // Aktifkan tombol "View"
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJalurMasuks::route('/'),
            'create' => Pages\CreateJalurMasuk::route('/create'),
            'view' => Pages\ViewJalurMasuk::route('/{record}'),
            'edit' => Pages\EditJalurMasuk::route('/{record}/edit'),
        ];
    }
}
