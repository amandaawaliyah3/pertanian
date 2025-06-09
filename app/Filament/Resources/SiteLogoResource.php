<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteLogoResource\Pages\EditSiteLogo;
use App\Models\SiteLogo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SiteLogoResource extends Resource
{
    protected static ?string $model = SiteLogo::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Logo Website';
    protected static ?string $navigationLabel = 'Pengaturan Logo';
    protected static ?string $navigationGroup = 'PENGATURAN';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pengaturan Logo')
                ->schema([
                    Forms\Components\FileUpload::make('logo_path')
                        ->label('Logo')
                        ->directory('site/logos')
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048)
                        ->required(),

                    Forms\Components\TextInput::make('institution_name')
                        ->label('Nama Institusi')
                        ->required(),

                    Forms\Components\TextInput::make('institution_subname')
                        ->label('Deskripsi Institusi')
                        ->required()
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('institution_name')
                    ->label('Nama Institusi'),

                Tables\Columns\TextColumn::make('institution_subname')
                    ->label('Deskripsi')
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => EditSiteLogo::route('/'),
        ];
    }
}
