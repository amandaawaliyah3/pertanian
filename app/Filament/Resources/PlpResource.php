<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlpResource\Pages;
use App\Models\Plp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class PlpResource extends Resource
{
    protected static ?string $model = Plp::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'PLP';
    protected static ?string $navigationLabel = 'Data PLP';
    protected static ?string $navigationGroup = 'PERTANIAN';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi PLP')
                    ->schema([
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->directory('plp')
                            ->columnSpanFull()
                            ->nullable(fn (string $operation): bool => $operation === 'edit'), // Izinkan null untuk update
                            
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('jabatan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('bidang_keahlian')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Toggle::make('status')
                            ->required()
                            ->default(true),

                        Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public') // Pastikan disk public
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->label('Bidang Keahlian'),

                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('aktif')
                    ->query(fn (Builder $query): Builder => $query->where('status', true)),

                Tables\Filters\Filter::make('tidak_aktif')
                    ->query(fn (Builder $query): Builder => $query->where('status', false)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                // ✅ Hapus foto saat Single Delete
                Tables\Actions\DeleteAction::make()
                    ->before(function (Plp $record) {
                        if ($record->foto) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // ✅ Hapus foto saat Bulk Delete
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (\Illuminate\Support\Collection $records) {
                            $records->each(function (Plp $record) {
                                if ($record->foto) {
                                    Storage::disk('public')->delete($record->foto);
                                }
                            });
                        }),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlps::route('/'),
            'create' => Pages\CreatePlp::route('/create'),
            'view' => Pages\ViewPlp::route('/{record}'),
            'edit' => Pages\EditPlp::route('/{record}/edit'),
        ];
    }
}