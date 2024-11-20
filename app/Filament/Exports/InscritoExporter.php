<?php

namespace App\Filament\Exports;

use App\Models\Inscrito;
use Carbon\Carbon;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;

class InscritoExporter extends Exporter
{
    protected static ?string $model = Inscrito::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('rut')
                ->label('RUT'),
            ExportColumn::make('lastnames')
                ->label('Apellidos'),
            ExportColumn::make('names')
                ->label('Nombres'),
            ExportColumn::make('birthday')
                ->label('Edad')
                ->formatStateUsing(fn ($state) => Carbon::parse($state)
                    ->diff(Carbon::createFromDate(null, 12, 25))
                    ->format('%y años, %m meses y %d días')
                ),
            ExportColumn::make('gender')
                ->label('Género')
                ->formatStateUsing(fn ($state) => [
                    'male' => 'Masculino',
                    'female' => 'Femenino',
                    'other' => 'Otro',
                ][$state] ?? 'Desconocido'),
            ExportColumn::make('sector.name')
                ->label('Sector'),
            ExportColumn::make('phone')
                ->label('Teléfono'),
            ExportColumn::make('created_at')
                ->label('Fecha inscripción')
                ->formatStateUsing(fn (string $state): string => Carbon::parse($state)->format('d/M/Y')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = sprintf(
            'Se completó el exportado con %s %s.',
            number_format($export->successful_rows),
            str('inscrito')->plural($export->successful_rows)
        );

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= sprintf(
                ' %s %s no pudieron ser exportados.',
                number_format($failedRowsCount),
                str('inscrito')->plural($failedRowsCount)
            );
        }

        return $body;
    }

    public function getXlsxCellStyle(): ?Style
    {
        return (new Style)
            ->setBorder(new Border(
                new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            ));
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        return (new Style)
            ->setFontBold()
            ->setFontColor(Color::WHITE)
            ->setBackgroundColor(Color::BLACK);
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Xlsx,
        ];
    }

    public function getFileName(Export $export): string
    {
        $now = Carbon::now();

        return sprintf(
            'Navidad%s_Inscritos_%s',
            $now->format('Y'),
            $now->format('Ymd')
        );
    }
}
