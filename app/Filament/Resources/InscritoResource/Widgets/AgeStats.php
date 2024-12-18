<?php

namespace App\Filament\Resources\InscritoResource\Widgets;

use App\Models\AgeStat;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AgeStats extends BaseWidget
{
    protected static ?string $heading = '';

    protected static ?string $pollingInterval = '120s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AgeStat::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('range')
                    ->label('Rango de edad')
                    ->extraAttributes(['style' => 'padding-top: 0.25rem !important; padding-bottom: 0.25rem !important']),
                Tables\Columns\TextColumn::make('total')
                    ->label('Inscritos')
                    ->extraAttributes(['style' => 'padding-top: 0.25rem !important; padding-bottom: 0.25rem !important'])
                    ->alignEnd(),
            ])
            ->paginated(false);
    }
}
