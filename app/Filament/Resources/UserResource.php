<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Informações do usuário')
                ->description('The items you have selected for purchase')
                ->icon('heroicon-m-shopping-bag')
                ->schema([

                    TextInput::make('name')->autofocus()->required()->placeholder('Fausto Cananga')->label('Nome'),

                    TextInput::make('email')->email()->required()->placeholder('faustocananga51@gmail.com'),

                    Toggle::make('activo')->default(true),
                ])

                
            ])
           
            
            ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagem')->label('Imagem')->circular(),

                TextColumn::make('name')->searchable()->sortable()->label('Nome'),

                TextColumn::make('email')->searchable()->sortable()->label('Email'),

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
                    Tables\Actions\BulkAction::make('Desactivar')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-circle')
                    
                    ->action(fn (Collection $users)=> $users->each->delete())
                    ->after(fn()=> Notification::make()
                        ->title('Salvo com sucesso')
                        ->success()
                        ->send())
                
                
                
                
                
                    ])->label('Opções'),
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
