<?php

namespace App\Filament\Resources;

use App\Models\Kerjasama;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\KerjasamaResource\Pages;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class KerjasamaResource extends Resource
{
    protected static ?string $model = Kerjasama::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'MITRA';
    protected static ?string $navigationLabel = 'Kerja sama';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Kerja sama')
                ->schema([
                    FileUpload::make('logo')
                        ->image()
                        ->directory('kerjasama-logos')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => (string) str(Str::slug($file->getClientOriginalName()))
                                ->prepend(time().'-')
                                ->append('.'.$file->getClientOriginalExtension())
                        )
                        ->imageEditor()
                        ->columnSpanFull(),

                    TextInput::make('nama_mitra')
                        ->required(),

                    TextInput::make('jenis_kerjasama')
                        ->required(),

                    DatePicker::make('tanggal_mulai')
                        ->required(),

                    DatePicker::make('tanggal_selesai')
                        ->required(),

                    Textarea::make('keterangan')
                        ->columnSpanFull(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->circular(),

                TextColumn::make('nama_mitra')
                    ->searchable(),

                TextColumn::make('jenis_kerjasama'),

                TextColumn::make('tanggal_mulai')
                    ->date(),

                TextColumn::make('tanggal_selesai')
                    ->date(),
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
