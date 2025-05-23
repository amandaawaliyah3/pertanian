<?php

namespace App\Filament\Resources;

use App\Models\Kerjasama;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\KerjasamaResource\Pages;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MataKuliahImport;

class KerjasamaResource extends Resource
{
    protected static ?string $model = Kerjasama::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationLabel = 'Kerjasama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Kerjasama')
                ->schema([
                    TextInput::make('nama_mitra')->required(),
                    TextInput::make('jenis_kerjasama')->required(),
                    DatePicker::make('tanggal_mulai')->required(),
                    DatePicker::make('tanggal_selesai')->required(),
                    Textarea::make('keterangan')->columnSpanFull(),
                ])->columns(2),

            Section::make('Penelitian')
                ->schema([
                    Repeater::make('penelitians')
                        ->relationship()
                        ->schema([
                            TextInput::make('judul')->required(),
                            TextInput::make('peneliti')->required(),
                            DatePicker::make('tahun')->required(),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->collapsible()
                        ->createItemButtonLabel('Tambah Penelitian'),
                ]),

            Section::make('Pengabdian')
                ->schema([
                    Repeater::make('pengabdians')
                        ->relationship()
                        ->schema([
                            TextInput::make('judul')->required(),
                            TextInput::make('pelaksana')->required(),
                            DatePicker::make('tahun')->required(),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->collapsible()
                        ->createItemButtonLabel('Tambah Pengabdian'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nama_mitra')->searchable(),
            TextColumn::make('jenis_kerjasama'),
            TextColumn::make('tanggal_mulai')->date(),
            TextColumn::make('tanggal_selesai')->date(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKerjasamas::route('/'),
            'create' => Pages\CreateKerjasama::route('/create'),
            'edit' => Pages\EditKerjasama::route('/{record}/edit'),
        ];
    }
}
