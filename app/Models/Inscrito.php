<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laragear\Rut\HasRut;
use Laragear\Rut\Rut;

/**
 * @property Rut $rut
 * @property string $names
 * @property string $lastnames
 * @property mixed $birthday
 * @property string $gender
 * @property mixed $phone
 * @property int $current_age
 * @property int $christmas_age
 * @property string $christmas_age_formatted
 *
 * @method static create(mixed[] $data)
 */
class Inscrito extends Model
{
    use HasFactory, HasRut, HasUlids, SoftDeletes;

    protected $fillable = [
        'rut',
        'names',
        'lastnames',
        'birthday',
        'gender',
        'phone',
        'sector_id',
    ];

    protected $appends = [
        'rut',
        'current_age',
        'christmas_age',
        'christmas_age_formatted',
    ];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
        ];
    }

    protected function getCurrentAgeAttribute(): int
    {
        $birthday = Carbon::parse($this->birthday);

        return $birthday->age;
    }

    public function getChristmasDiff(): CarbonInterval
    {
        $birthdayTime = Carbon::parse($this->birthday);
        $christmasTime = Carbon::createFromDate(null, 12, 25);

        return $christmasTime->diff($birthdayTime);
    }

    protected function getChristmasAgeAttribute(): int
    {
        return $this->getChristmasDiff()->y;
    }

    protected function getChristmasAgeFormattedAttribute(): string
    {
        return $this->getChristmasDiff()->format('%y años, %m meses y %d días');
    }

    public static function getAgeStats(?int $year = null): array
    {
        $year = $year ?? Carbon::now()->year;
        $inscritos = static::all();

        // Definimos los rangos y sus breakpoints
        $ranges = [
            '0 años' => 1,
            '1 a 2 años' => 3,
            '3 a 4 años' => 5,
            '5 a 6 años' => 7,
            '7 a 8 años' => 9,
            '9 a 10 años' => 11,
            'más de 10 años' => 999,
        ];

        // Agrupamos los inscritos según su edad
        $grouped = $inscritos->map(function ($inscrito) use ($ranges) {
            foreach ($ranges as $label => $breakpoint) {
                if ($breakpoint > $inscrito->christmas_age) {
                    return [
                        'range' => $label,
                        'total' => 1,  // Para poder sumar después
                    ];
                }
            }

            // Si no entró en ningún rango, va al último
            return [
                'range' => array_key_last($ranges),
                'total' => 1,
            ];
        });

        // Sumamos los totales por grupo
        $stats = $grouped->groupBy('range')
            ->map(fn ($group) => [
                'range' => $group->first()['range'],
                'total' => $group->count(),
            ])
            ->values()
            ->sortBy('range')
            ->toArray();

        return array_values($stats);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
