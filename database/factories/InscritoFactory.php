<?php

namespace Database\Factories;

use App\Models\Inscrito;
use App\Models\Sector;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laragear\Rut\Facades\Generator;
use Laragear\Rut\Rut;

class InscritoFactory extends Factory
{
    protected $model = Inscrito::class;

    // Person RUT ranges according to docs: 100.000 to 45.999.999
    // Temporal RUT ranges: 100.000.000 to 199.999.999
    protected const PERSON_RUT_MIN = 100000;

    protected const PERSON_RUT_MAX = 45999999;

    protected const TEMPORAL_RUT_MIN = 100000000;

    protected const TEMPORAL_RUT_MAX = 199999999;

    protected $sectorWeights = [
        'Infiernillo' => 14.8,
        'Los Poetas' => 8.6,
        'Reina del Mar' => 8.0,
        'Las Proteas' => 6.3,
        'Los Andes' => 5.8,
        'Pueblo de Viudas' => 5.6,
        'Mar Azul' => 5.5,
        'Pichilemu Centro' => 5.3,
        'El Llano' => 5.1,
        'Los Jardines' => 4.0,
        'other' => 31.0,
    ];

    protected $ageDistribution = [
        0 => 8.5,
        1 => 8.6,
        2 => 8.6,
        3 => 7.8,
        4 => 7.7,
        5 => 7.7,
        6 => 9.0,
        7 => 9.0,
        8 => 8.9,
        9 => 8.1,
        10 => 8.1,
        11 => 8.0,
    ];

    public function definition(): array
    {
        // Generate RUT with 3.2% chance of being temporal
        $useTemporalRut = fake()->boolean(3.2);

        if ($useTemporalRut) {
            $rut = Generator::unique()
                ->make(1, self::TEMPORAL_RUT_MIN, self::TEMPORAL_RUT_MAX)
                ->first();
        } else {
            $rut = Generator::unique()
                ->make(1, self::PERSON_RUT_MIN, self::PERSON_RUT_MAX)
                ->first();
        }

        $selectedAge = $this->weightedRandom($this->ageDistribution);
        $monthsVariation = fake()->numberBetween(0, 11);

        $birthdate = Carbon::now()
            ->subYears($selectedAge)
            ->subMonths($monthsVariation);

        // Chilean phone format
        $phone = '+569'.fake()->numerify('########');

        $gender = fake()->randomFloat() < 0.01 ? 'other' :
                 (fake()->boolean(51.7) ? 'female' : 'male');

        $sectorName = $this->weightedRandom($this->getSectorWeights());
        $sector = Sector::where('name', $sectorName)->first() ??
                 Sector::inRandomOrder()->first();

        return [
            'rut' => $rut->format(),
            'names' => fake()->firstName().' '.fake()->firstName(),
            'lastnames' => fake()->lastName().' '.fake()->lastName(),
            'birthday' => $birthdate->format('Y-m-d'),
            'gender' => $gender,
            'phone' => $phone,
            'sector_id' => $sector->id,
        ];
    }

    protected function weightedRandom(array $weights): mixed
    {
        $rand = fake()->randomFloat(8, 0, 100);
        $total = 0;

        foreach ($weights as $key => $weight) {
            $total += is_array($weight) ? $weight['weight'] : $weight;
            if ($rand <= $total) {
                return is_array($weight) ? $weight : $key;
            }
        }

        return array_key_first($weights);
    }

    protected function getSectorWeights(): array
    {
        $sectors = Sector::all();
        $weights = [];

        foreach ($sectors as $sector) {
            $weights[$sector->name] = $this->sectorWeights[$sector->name] ??
                                    $this->sectorWeights['other'] /
                                    ($sectors->count() - count($this->sectorWeights) + 1);
        }

        return $weights;
    }
}
