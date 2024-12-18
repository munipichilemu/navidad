<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class AgeStat extends Model
{
    use Sushi;

    public function getRows(): array
    {
        return Inscrito::getAgeStats();
    }
}
