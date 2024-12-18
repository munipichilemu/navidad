<?php

namespace App\Services;

use App\Models\Inscrito;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InscritoExcelExporter
{
    private function getInscritosByRange(string $range): Collection
    {
        return Inscrito::query()
            ->select([
                'inscritos.rut_num',
                'inscritos.rut_vd',
                'inscritos.names',
                'inscritos.lastnames',
                'inscritos.birthday',
                'inscritos.gender',
                'inscritos.phone',
                'sectors.name as sector',
                'inscritos.created_at',
            ])
            ->join('sectors', 'sectors.id', '=', 'inscritos.sector_id')
            ->tap(fn ($query) => AgeRangeCalculator::filterQuery($query, $range))
            ->get();
    }

    public function download(): StreamedResponse
    {
        $now = Carbon::now();
        $filename = sprintf(
            'Navidad%s_Inscritos_%s.xlsx',
            $now->format('Y'),
            $now->format('Ymd')
        );

        return response()->streamDownload(function () use ($filename) {
            $writer = SimpleExcelWriter::streamDownload($filename);

            foreach (AgeRangeCalculator::RANGES as $range => $label) {
                if ($range !== array_key_first(AgeRangeCalculator::RANGES)) {
                    $writer->addNewSheetAndMakeItCurrent();
                }

                $writer->nameCurrentSheet($label);

                $inscritos = $this->getInscritosByRange($range);

                if ($inscritos->isEmpty()) {
                    continue;
                }

                $rows = $inscritos->map(function ($inscrito) {
                    return [
                        'RUT' => $inscrito->rut,
                        'Apellidos' => $inscrito->lastnames,
                        'Nombres' => $inscrito->names,
                        'Edad' => $inscrito->christmas_age_formatted,
                        'Género' => match ($inscrito->gender) {
                            'female' => 'Femenino',
                            'male' => 'Masculino',
                            default => 'Otro'
                        },
                        'Sector' => $inscrito->sector,
                        'Teléfono' => $inscrito->phone,
                        'F. Inscripción' => $inscrito->created_at->format('d/m/Y'),
                    ];
                });

                $writer->addRows($rows->all());
                flush();
            }

            $writer->close();
        }, $filename);
    }
}
