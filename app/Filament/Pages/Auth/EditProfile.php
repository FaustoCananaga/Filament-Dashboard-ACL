<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Tables\Columns\TextColumn;

class EditProfile extends BaseEditProfile
{

    
    public function getView(): string
    {
       return static::$view ?? 'filament.pages.auth.edit-profile';
    }
    
    protected static string $layout = 'filament-panels::components.layout.index';
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
               

               Section::make('Editar perfil')
               ->description('')
               ->icon('heroicon-s-user')
               ->schema([
                /* TextInput::make('username')
                    ->required()
                    ->maxLength(255),
               */
                $this->getNameFormComponent(),
                $this->getEmailFormComponent()->label('Email'),
                $this->getImagemFormComponent(),

                Select::make('genero')
                ->options([
                    'Masculino' => 'Masculino',
                    'Feminino' => 'Feminino',
                    'Outro' => 'Outro',
                ])->default('Masculino')->native(false)->label('Genero')->nullable(false),

                Select::make('role')
                    ->label('Pelfil')
                    
                    ->relationship('roles','name')->disabled(),
                
                Toggle::make('activo')->default(true),
                $this->getPasswordFormComponent()->label('Nova Senha'),
                $this->getPasswordConfirmationFormComponent()->label('Confirmar Nova Senha'),
                   
               ])->label('Perfil')

               
            ]);
    }
    
}
