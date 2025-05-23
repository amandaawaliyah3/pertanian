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

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Media Sosial')
                ->schema([
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook URL'),
                    Forms\Components\TextInput::make('twitter_url')
                        ->label('Twitter URL'),
                    Forms\Components\TextInput::make('instagram_url')
                        ->label('Instagram URL'),
                    Forms\Components\TextInput::make('youtube_url')
                        ->label('YouTube URL'),
                ])->columns(2),
                
            Forms\Components\Section::make('Kontak')
                ->schema([
                    Forms\Components\Textarea::make('address')
                        ->label('Alamat')
                        ->required(),
                    Forms\Components\TextInput::make('phone')
                        ->label('Telepon')
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required(),
                ]),
                
            Forms\Components\Section::make('Peta')
                ->schema([
                    Forms\Components\Textarea::make('map_embed_url')
                        ->label('Embed URL Peta')
                        ->required(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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