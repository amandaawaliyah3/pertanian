<?php

namespace App\Filament\Resources;

use App\Models\InfoBox;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\InfoBoxResource\Pages;
use Filament\Forms\Components\Select;


class InfoBoxResource extends Resource
{
    protected static ?string $model = InfoBox::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'PENGATURAN';
    protected static ?string $modelLabel = 'Info Box';
    protected static ?string $pluralModelLabel = 'Info Boxes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('icon')
                ->label('Icon (Font Awesome)')
                ->options([
                    'fa-solid fa-leaf' => '🍃 Pertanian / Alam',
                    'fa-solid fa-seedling' => '🌱 Bibit / Tanaman',
                    'fa-solid fa-tractor' => '🚜 Traktor / Peralatan',
                    'fa-solid fa-flask' => '🧪 Laboratorium',
                    'fa-solid fa-graduation-cap' => '🎓 Pendidikan',
                    'fa-solid fa-users' => '👥 Mahasiswa / Dosen',
                    'fa-solid fa-handshake' => '🤝 Kerjasama Industri',
                    'fa-solid fa-book' => '📚 Akademik',
                    'fa-solid fa-microscope' => '🔬 Penelitian',
                    'fa-solid fa-lightbulb' => '💡 Inovasi',
                    'fa-solid fa-chart-line' => '📈 Prestasi',
                    'fa-solid fa-award' => '🏅 Akreditasi',
                    'fa-solid fa-globe' => '🌐 Internasionalisasi',
                ])
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('judul')
                ->label('Judul')
                ->required(),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->required()
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('judul')
                ->label('Judul')
                ->searchable(),

           Tables\Columns\TextColumn::make('icon')
                ->label('Icon')
                ->html()
                ->formatStateUsing(fn ($state) => "<i class='$state fa-lg text-success'></i>"),


            Tables\Columns\TextColumn::make('deskripsi')
                ->label('Deskripsi')
                ->limit(50),
        ])
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
            'index' => Pages\ListInfoBoxes::route('/'),
            'create' => Pages\CreateInfoBox::route('/create'),
            'edit' => Pages\EditInfoBox::route('/{record}/edit'),
        ];
    }
}
