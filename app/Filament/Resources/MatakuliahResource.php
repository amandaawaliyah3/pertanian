<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataKuliahResource\Pages;
use App\Models\MataKuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MataKuliahImport;

class MataKuliahResource extends Resource
{
    protected static ?string $model = MataKuliah::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $modelLabel = 'Mata Kuliah';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Mata Kuliah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Mata Kuliah')
                    ->schema([
                        Forms\Components\TextInput::make('kode')
                            ->label('Kode MK')
                            ->required()
                            ->maxLength(10)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('semester')
                            ->options([
                                1 => 'Semester 1',
                                2 => 'Semester 2',
                                3 => 'Semester 3',
                                4 => 'Semester 4',
                                5 => 'Semester 5',
                                6 => 'Semester 6',
                                7 => 'Semester 7',
                                8 => 'Semester 8',
                            ])
                            ->required(),
                        Forms\Components\Select::make('jenis')
                            ->label('Jenis')
                            ->options([
                                'wajib' => 'Wajib',
                                'pilihan' => 'Pilihan',
                            ])
                            ->default('wajib')
                            ->required(),
                        Forms\Components\Select::make('prasyarat')
                            ->label('Prasyarat (Kode MK)')
                            ->options(MataKuliah::all()->pluck('nama', 'kode'))
                            ->searchable()
                            ->nullable(),
                    ])->columns(2),

                Forms\Components\Section::make('SKS')
                    ->schema([
                        Forms\Components\TextInput::make('sks_teori')
                            ->label('SKS Teori')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(10)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('total_sks', (int) $state + (int) $get('sks_praktikum'));
                            }),
                        Forms\Components\TextInput::make('sks_praktikum')
                            ->label('SKS Praktikum')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(10)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('total_sks', (int) $state + (int) $get('sks_teori'));
                            }),
                        Forms\Components\TextInput::make('total_sks')
                            ->label('Total SKS')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                                $component->state(
                                    ($record?->sks_teori ?? 0) + ($record?->sks_praktikum ?? 0)
                                );
                            }),
                    ])->columns(3),

                Forms\Components\Section::make('Detail Mata Kuliah')
                    ->schema([
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('capaian_pembelajaran')
                            ->label('Capaian Pembelajaran')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('referensi')
                            ->label('Referensi')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'wajib' => 'success',
                        'pilihan' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('sks_teori')
                    ->label('SKS T')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sks_praktikum')
                    ->label('SKS P')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_sks')
                    ->label('Total SKS')
                    ->state(fn (MataKuliah $record) => $record->sks_teori + $record->sks_praktikum)
                    ->sortable(),
                Tables\Columns\TextColumn::make('prasyarat')
                    ->label('Prasyarat')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2',
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                        7 => 'Semester 7',
                        8 => 'Semester 8',
                    ]),
                Tables\Filters\SelectFilter::make('jenis')
                    ->options([
                        'wajib' => 'Wajib',
                        'pilihan' => 'Pilihan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Action::make('importExcel')
                    ->label('Import Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('primary')
                    ->modalHeading('Import Data Mata Kuliah')
                    ->modalDescription('Silakan upload file Excel dengan format yang sesuai')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('File Excel')
                            ->required()
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel'
                            ])
                    ])
                    ->action(function (array $data) {
                        try {
                            Excel::import(new MataKuliahImport, $data['file']);
                            Notification::make()
                                ->title('Import Berhasil')
                                ->body('Data mata kuliah telah berhasil diimport')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Import Gagal')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('semester');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMataKuliahs::route('/'),
            'create' => Pages\CreateMataKuliah::route('/create'),
            'edit' => Pages\EditMataKuliah::route('/{record}/edit'),
        ];
    }
}