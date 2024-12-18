<?php

namespace App\Filament\Resources\SectorResource\Widgets;

use App\Models\Inscrito;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class SectorStats extends BaseWidget
{
    protected static ?string $heading = '';

    protected static ?string $pollingInterval = '120s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inscrito::query()
                    ->select('sectors.id', 'sectors.name', DB::raw('count(*) as total'))
                    ->join('sectors', 'sectors.id', '=', 'inscritos.sector_id')
                    ->groupBy('sectors.id', 'sectors.name')
                    ->orderByDesc('total')
                    ->take(7)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Sectores más populares')
                    ->extraAttributes(['style' => 'padding-top: 0.25rem !important; padding-bottom: 0.25rem !important']),
                Tables\Columns\TextColumn::make('total')
                    ->label('Inscritos')
                    ->extraAttributes(['style' => 'padding-top: 0.25rem !important; padding-bottom: 0.25rem !important'])
                    ->alignEnd(),
            ])
            ->paginated(false);
    }
}
