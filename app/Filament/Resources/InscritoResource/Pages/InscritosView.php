<?php

namespace App\Filament\Resources\InscritoResource\Pages;

use App\Filament\Resources\InscritoResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

/**
 * @property $record
 */
class InscritosView extends ViewRecord
{
    protected static string $resource = InscritoResource::class;

    public function getTitle(): string|Htmlable
    {
        return "{$this->record->names} {$this->record->lastnames}";
    }

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->rut;
    }
}
