<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $modelLabel = 'Pengaturan Footer';
    protected static ?string $navigationLabel = 'Pengaturan Footer';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Media Sosial')
                ->schema([
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook URL')
                        ->placeholder('https://facebook.com/username')
                        ->maxLength(255),
                        
                    Forms\Components\TextInput::make('twitter_url')
                        ->label('Twitter URL')
                        ->placeholder('https://twitter.com/username')
                        ->maxLength(255),
                        
                    Forms\Components\TextInput::make('instagram_url')
                        ->label('Instagram URL')
                        ->placeholder('https://instagram.com/username')
                        ->maxLength(255),
                        
                    Forms\Components\TextInput::make('youtube_url')
                        ->label('YouTube URL')
                        ->placeholder('https://youtube.com/channel/...')
                        ->maxLength(255),
                ])
                ->columns(2),
                
            Forms\Components\Section::make('Informasi Kontak')
                ->schema([
                    Forms\Components\Textarea::make('address')
                        ->label('Alamat Lengkap')
                        ->required()
                        ->maxLength(500)
                        ->columnSpanFull()
                        ->placeholder('Jl. Contoh No. 123, Kota, Provinsi, Kode Pos'),
                        
                    Forms\Components\TextInput::make('phone')
                        ->label('Nomor Telepon')
                        ->required()
                        ->maxLength(20)
                        ->placeholder('081234567890'),
                        
                    Forms\Components\TextInput::make('email')
                        ->label('Alamat Email')
                        ->email()
                        ->required()
                        ->maxLength(100)
                        ->placeholder('info@example.com'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->address),
                    
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),
                    
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFooterSettings::route('/'),
            'create' => Pages\CreateFooterSetting::route('/create'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }
}