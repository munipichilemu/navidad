<?php

namespace App\Filament\Resources\InscritoResource\Pages;

use App\Filament\Resources\InscritoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInscritos extends ManageRecords
{
    protected static string $resource = InscritoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo inscrito')
                ->icon('heroicon-s-plus'),
        ];
    }
}
