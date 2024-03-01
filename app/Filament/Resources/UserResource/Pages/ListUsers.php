<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTabs(): array
{
    return [
        'Todos' => Tab::make(),
        'Activos' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('activo', true)),
        'Inativos' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('activo', false)),
    ];
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Novo Usuário'),
        ];
    }
}
