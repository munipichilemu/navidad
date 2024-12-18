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

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
