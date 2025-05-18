<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataKuliahResource\Pages;
use App\Models\MataKuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MataKuliahResource extends Resource
{
    protected static ?string $model = MataKuliah::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $modelLabel = 'Mata Kuliah';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Mata Kuliah')
                    ->schema([
                        Forms\Components\TextInput::make('kode')
                            ->required()
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->label('Kode MK'),
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
                            ->options([
                                'wajib' => 'Wajib',
                                'pilihan' => 'Pilihan',
                            ])
                            ->default('wajib')
                            ->required(),
                        Forms\Components\Select::make('prasyarat')
                            ->options(MataKuliah::all()->pluck('nama', 'kode'))
                            ->searchable()
                            ->nullable()
                            ->label('Prasyarat (Kode MK)'),
                    ])->columns(2),

                Forms\Components\Section::make('SKS')
                    ->schema([
                        Forms\Components\TextInput::make('sks_teori')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(10)
                            ->label('SKS Teori')
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('total_sks', (int) $state + (int) $get('sks_praktikum'));
                            }),

                        Forms\Components\TextInput::make('sks_praktikum')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(10)
                            ->label('SKS Praktikum')
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('total_sks', (int) $state + (int) $get('sks_teori'));
                            }),

                        Forms\Components\TextInput::make('total_sks')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->label('Total SKS')
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                                // Kalau record null (pas create), total_sks = 0
                                $component->state(
                                    ($record?->sks_teori ?? 0) + ($record?->sks_praktikum ?? 0)
                                );
                            }),
                    ])->columns(3),

                Forms\Components\Section::make('Detail Mata Kuliah')
                    ->schema([
                        Forms\Components\Textarea::make('deskripsi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('capaian_pembelajaran')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('referensi')
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
                    ->searchable()
                    ->sortable()
                    ->label('Kode'),
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
                    ->state(function (MataKuliah $record) {
                        return $record->sks_teori + $record->sks_praktikum;
                    })
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
