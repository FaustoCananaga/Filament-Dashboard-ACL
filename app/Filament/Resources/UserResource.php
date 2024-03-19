<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Actions\SelectAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel ='Utilizador';
   // protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup ='Geral';
   // protected static ?string $recordTitleAttribute = 'name';
   

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Informações do usuário')
                ->description('')
                ->icon('heroicon-s-user')
                ->schema([

                    TextInput::make('name')->autofocus()->required()->placeholder('Digite o seu nome')->label('Nome'),

                    TextInput::make('email')->email()->required()->placeholder('Digite o seu email'),
                   
                    Select::make('genero')
                    ->options([
                        'Masculino' => 'Masculino',
                        'Feminino' => 'Feminino',
                        'Outro' => 'Outro',
                    ])->default('Masculino')->native(false)->label('Genero')->nullable(false),

                    
                    FileUpload::make('imagem')->image()->avatar()
                    ->imageEditor()
                    ->circleCropper()->placeholder('Carregar'),

                    TextInput::make('password')->autocomplete('new-password')->label('Criar password')->password()->required()->placeholder('Digite a Senha'),

                    Toggle::make('activo')->default(true),
                ])

                
            ]);
           
            
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagem')->label('Imagem')->circular()->overlap(2)->wrap(),

                TextColumn::make('name')->searchable()->sortable()->label('Nome'),

                TextColumn::make('email')->searchable()->sortable()->label('Email'),

                TextColumn::make('genero')->searchable()->sortable()->label('Genero'),

                IconColumn::make('activo')->boolean()->label('Status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
            ])
            ->bulkActions([ 
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Apagar Selecionados'),

                    /*  
                    Tables\Actions\BulkAction::make('Desactivar')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-circle')
                    
                    ->action(fn (Collection $users)=> $users->each->delete())
                    ->after(fn()=> Notification::make()
                        ->title('Salvo com sucesso')
                        ->success()
                        ->send())
                    */

                    ])->label('Opções') , 
                   
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
