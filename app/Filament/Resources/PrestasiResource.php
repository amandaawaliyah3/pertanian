<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Prestasi Mahasiswa';
    protected static ?string $pluralModelLabel = 'Prestasi Mahasiswa';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->required()
                ->maxLength(255),

            Textarea::make('deskripsi')
                ->required()
                ->rows(6),

            FileUpload::make('gambar')
                ->directory('prestasi')
                ->image()
                ->nullable(),

            DatePicker::make('tanggal')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable()->sortable(),
                TextColumn::make('tanggal')->date()->sortable(),
                ImageColumn::make('gambar')->disk('public'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('tanggal', 'desc');
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
