<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SejarahResource\Pages;
use App\Models\Sejarah;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;

class SejarahResource extends Resource
{
    protected static ?string $model = Sejarah::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Sejarah';
    protected static ?string $pluralModelLabel = 'Sejarah';
    protected static ?string $modelLabel = 'Sejarah';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('konten')
                ->label('Isi Sejarah')
                ->required()
                ->rows(15),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('konten')
                    ->label('Isi Sejarah')
                    ->limit(100)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSejarahs::route('/'),
            'edit' => Pages\EditSejarah::route('/{record}/edit'),
        ];
    }
}
