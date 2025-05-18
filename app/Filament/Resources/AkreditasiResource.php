<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AkreditasiResource\Pages;
use App\Models\Akreditasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class AkreditasiResource extends Resource
{
    protected static ?string $model = Akreditasi::class;
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationLabel = 'Akreditasi';
    protected static ?string $pluralModelLabel = 'Akreditasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('lembaga')
                ->label('Lembaga Akreditasi')
                ->required(),

            Forms\Components\TextInput::make('peringkat')
                ->label('Peringkat')
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Akreditasi')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('lembaga'),
            Tables\Columns\TextColumn::make('peringkat'),
            Tables\Columns\TextColumn::make('tanggal')->date('d M Y'),
            Tables\Columns\TextColumn::make('created_at')->label('Tanggal Input')->dateTime('d M Y H:i'),
        ])
        ->defaultSort('tanggal', 'desc')
        ->actions([
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
            'index' => Pages\ListAkreditasis::route('/'),
            'create' => Pages\CreateAkreditasi::route('/create'),
            'edit' => Pages\EditAkreditasi::route('/{record}/edit'),
        ];
    }
}
