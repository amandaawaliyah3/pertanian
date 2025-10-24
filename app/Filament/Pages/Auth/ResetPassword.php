<?php
namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\PasswordReset\ResetPassword as BaseResetPassword;

class ResetPassword extends BaseResetPassword
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->disabled()
                    ->autocomplete('username'),
                TextInput::make('password')
                    ->label('Password Baru')
                    ->password()
                    ->required()
                    ->rules(['confirmed'])
                    ->autocomplete('new-password'),
                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password Baru')
                    ->password()
                    ->required()
                    ->autocomplete('new-password'),
            ]);
    }
}
