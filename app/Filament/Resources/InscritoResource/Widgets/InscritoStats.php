<?php

namespace App\Filament\Resources\InscritoResource\Widgets;

use App\Models\Inscrito;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InscritoStats extends BaseWidget
{
    protected static ?string $pollingInterval = '120s';

    protected function getStats(): array
    {
        $now = Carbon::now();
        $lastWeek = Carbon::now()->subWeek();

        $previousWeek = Inscrito::whereBetween('created_at', [
            $lastWeek->startOfWeek(),
            $lastWeek->copy()->setTime($now->hour, $now->minute),
        ])->count();

        $currentWeek = Inscrito::whereBetween('created_at', [
            $now->copy()->startOfWeek(),
            $now,
        ])->count();

        $trend = $currentWeek - $previousWeek;
        $color = $trend >= 0 ? Color::Green : Color::Red;

        $data = Trend::model(Inscrito::class)
            ->between(
                start: Carbon::now()->startOfMonth(),
                end: Carbon::now()
            )
            ->perDay()
            ->count();

        return [
            Stat::make('Inscritos totales', Inscrito::count())
                ->description("Este mes: {$data->sum('aggregate')} – Por semana: $trend")
                ->descriptionIcon($trend >= 0 ? 'fas-arrow-trend-up' : 'fas-arrow-trend-down')
                ->color($color)
                ->chart(
                    $data
                        ->map(fn (TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),
        ];
    }
}
