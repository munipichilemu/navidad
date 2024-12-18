<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class AgeRangeCalculator
{
    public const RANGES = [
        '0-1' => '0 años',
        '1-2' => '1 a 2 años',
        '3-4' => '3 a 4 años',
        '5-6' => '5 a 6 años',
        '7-8' => '7 a 8 años',
        '9-10' => '9 a 10 años',
        '10+' => 'más de 10 años',
    ];

    public static function filterQuery(Builder $query, string $range): Builder
    {
        $christmasDate = Carbon::createFromDate(null, 12, 25);

        return match ($range) {
            '0-1' => $query->whereBetween(
                'birthday',
                [$christmasDate->copy()->subYear(), $christmasDate->copy()]
            ),
            '1-2' => $query->whereBetween(
                'birthday',
                [$christmasDate->copy()->subYears(3), $christmasDate->copy()->subYear()]
            ),
            '3-4' => $query->whereBetween(
                'birthday',
                [$christmasDate->copy()->subYears(5), $christmasDate->copy()->subYears(3)]
            ),
            '5-6' => $query->whereBetween(
                'birthday',
                [$christmasDate->copy()->subYears(7), $christmasDate->copy()->subYears(5)]
            ),
            '7-8' => $query->whereBetween(
                'birthday',
                [$christmasDate->copy()->subYears(9), $christmasDate->copy()->subYears(7)]
            ),
            '9-10' => $query->whereBetween(
                'birthday',
                [$christmasDate->copy()->subYears(11), $christmasDate->copy()->subYears(9)]
            ),
            '10+' => $query->where('birthday', '<',
                $christmasDate->copy()->subYears(11)
            ),
            default => $query
        };
    }
}
