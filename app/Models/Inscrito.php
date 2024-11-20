<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laragear\Rut\HasRut;

/**
 * @property mixed $rut
 * @property mixed $names
 * @property mixed $lastnames
 * @property mixed $birthday
 * @property mixed $gender
 * @property mixed $phone
 * @method static create(mixed[] $data)
 */
class Inscrito extends Model
{
    use HasFactory, HasRut, HasUlids, SoftDeletes;

    protected $casts = [
        'birthday' => 'date',
    ];

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
    ];

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
