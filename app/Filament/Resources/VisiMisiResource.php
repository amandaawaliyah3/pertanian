<?php
namespace App\Filament\Resources;

use App\Filament\Resources\VisiMisiResource\Pages;
use App\Models\VisiMisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class VisiMisiResource extends Resource
{
    protected static ?string $model = VisiMisi::class;
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationLabel = 'Visi & Misi';
    protected static ?string $pluralModelLabel = 'Visi Misi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('visi')
                ->label('Visi')
                ->required()
                ->rows(5),

            Forms\Components\Textarea::make('misi')
                ->label('Misi')
                ->required()
                ->rows(7),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('visi')->limit(50),
            Tables\Columns\TextColumn::make('misi')->limit(50),
            Tables\Columns\TextColumn::make('created_at')->label('Tanggal Input')->dateTime('d M Y H:i'),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisiMisis::route('/'),
            'create' => Pages\CreateVisiMisi::route('/create'),
            'edit' => Pages\EditVisiMisi::route('/{record}/edit'),
        ];
    }
}
