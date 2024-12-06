<?php

namespace App\Filament\Resources;

use App\Filament\Exports\InscritoExporter;
use App\Filament\Resources\InscritoResource\Pages;
use App\Models\Inscrito;
use App\Models\Sector;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Laragear\Rut\Rut;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class InscritoResource extends Resource
{
    protected static ?string $model = Inscrito::class;

    protected static ?string $navigationIcon = 'heroicon-s-gift';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rut')
                    ->label('RUT')
                    ->rules(['rut'])
                    ->rules(
                        ['rut_unique:inscritos,rut_num,rut_vd'],
                        fn (string $context): bool => $context === 'create'
                    )
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => strlen($state) > 3
                        ? $set('rut', Rut::parse($state)->format())
                        : $state
                    )
                    ->formatStateUsing(fn (?string $state): string => $state ?? '')
                    ->disabled(fn (string $context): bool => $context === 'edit')
                    ->validationAttribute('rut')
                    ->required(),

                Forms\Components\TextInput::make('names')
                    ->label('Nombres')
                    ->columnStart(1)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => strlen($state) > 1
                        ? $set('names', \Str::title(trim($state)))
                        : $state
                    )
                    ->formatStateUsing(fn (?string $state): string => $state ?? '')
                    ->required(),
                Forms\Components\TextInput::make('lastnames')
                    ->label('Apellidos')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => strlen($state) > 1
                        ? $set('lastnames', \Str::title(trim($state)))
                        : $state
                    )
                    ->formatStateUsing(fn (?string $state): string => $state ?? '')
                    ->required(),

                Forms\Components\DatePicker::make('birthday')
                    ->label('Fecha de nacimiento')
                    ->required(),
                Forms\Components\ToggleButtons::make('gender')
                    ->label('Género')
                    ->options([
                        'female' => 'Femenino',
                        'male' => 'Masculino',
                        'other' => 'Otro',
                    ])
                    ->colors([
                        'female' => Color::Pink,
                        'male' => Color::Indigo,
                        'other' => Color::Cyan,
                    ])
                    ->icons([
                        'female' => 'fas-venus',
                        'male' => 'fas-mars',
                        'other' => 'fas-genderless',
                    ])
                    ->inline()
                    ->grouped()
                    ->required(),

                PhoneInput::make('phone')
                    ->label('Teléfono')
                    ->defaultCountry('CL')
                    ->initialCountry('CL')
                    ->disallowDropdown()
                    ->inputNumberFormat(PhoneInputNumberType::E164)
                    ->separateDialCode()
                    ->required(),
                Forms\Components\Select::make('sector_id')
                    ->label('Sector')
                    ->relationship('sector', 'name')
                    ->searchable()
                    ->options(
                        Sector::all()
                            ->groupBy('group')
                            ->map(fn ($group) => $group->mapWithKeys(fn ($item) => [$item['id'] => $item['name']]))
                            ->mapWithKeys(fn ($item, $key) => [ucfirst($key) => $item])
                    )
                    ->preload()
                    ->nullable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('names')
                    ->label('Nombre completo')
                    ->formatStateUsing(fn (Inscrito $record): string => "$record->names $record->lastnames")
                    ->description(fn (Inscrito $record): string => $record->rut)
                    ->searchable(['rut_num', 'names', 'lastnames']),
                Tables\Columns\TextColumn::make('birthday')
                    ->label('Edad')
                    ->formatStateUsing(fn (string $state) => sprintf(
                        '%s años',
                        Carbon::parse($state)->age)
                    )
                    ->description(fn (string $state): HtmlString => new HtmlString(sprintf(
                        '<svg class="w-4 h-4 inline-block mr-1" style="fill: currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M150.2 71l47.1-17.7L215 6.2c1.4-3.8 5-6.2 9-6.2s7.6 2.5 9 6.2l17.7 47.1L297.8 71c3.8 1.4 6.2 5 6.2 9s-2.5 7.6-6.2 9l-47.1 17.7L233 153.8c-1.4 3.8-5 6.2-9 6.2s-7.6-2.5-9-6.2l-17.7-47.1L150.2 89c-3.8-1.4-6.2-5-6.2-9s2.5-7.6 6.2-9zm125.3 60.5l15.8-5.9 122 193.1c4.7 7.4 4.9 16.7 .7 24.4s-12.3 12.4-21 12.4l-25.3 0 76.5 119.5c4.7 7.4 5 16.8 .8 24.5s-12.3 12.5-21.1 12.5L24 512c-8.8 0-16.8-4.8-21.1-12.5s-3.9-17.1 .8-24.5L80.3 355.5l-25.3 0c-8.7 0-16.8-4.8-21-12.4s-3.9-17 .7-24.4l122-193.1 15.8 5.9L185 165c.4 1.2 .9 2.3 1.4 3.4L98.6 307.5l25.6 0c8.8 0 16.8 4.8 21.1 12.5s3.9 17.1-.8 24.5L67.9 464l312.3 0L303.6 344.5c-4.7-7.4-5.1-16.8-.8-24.5s12.3-12.5 21.1-12.5l25.6 0L261.5 168.4c.5-1.1 1-2.2 1.4-3.4l12.6-33.5zM160 280a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM288 392a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> %s',
                        Carbon::parse($state)->diff(Carbon::createFromDate(null, 12, 25))->format('%y años, %m meses y %d días')
                    )))
                    ->sortable(),
                PhoneColumn::make('phone')
                    ->label('Teléfono')
                    ->displayFormat(PhoneInputNumberType::INTERNATIONAL)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sector.name')
                    ->label('Sector')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrito')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->toggleColumnsTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Columnas'),
            )
            ->defaultSort('created_at', 'DESC')
            ->filters([
                Filter::make('age_range')
                    ->form([
                        Select::make('age_range')
                            ->options([
                                '0-1' => '0 años',
                                '1-2' => '1 a 2 años',
                                '3-4' => '3 a 4 años',
                                '5-6' => '5 a 6 años',
                                '7-8' => '7 a 8 años',
                                '9-10' => '9 a 10 años',
                                '10+' => 'más de 10 años',
                            ])
                            ->label('Tramo de edad'),
                    ])
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['age_range']) {
                            return null;
                        }

                        $labels = [
                            '0-1' => '0 años',
                            '1-2' => '1 a 2 años',
                            '3-4' => '3 a 4 años',
                            '5-6' => '5 a 6 años',
                            '7-8' => '7 a 8 años',
                            '9-10' => '9 a 10 años',
                            '10+' => 'más de 10 años',
                        ];

                        return 'Edad: '.$labels[$data['age_range']];
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        if (! $data['age_range']) {
                            return $query;
                        }

                        $christmasDate = Carbon::createFromDate(null, 12, 25);

                        return match ($data['age_range']) {
                            '0-1' => $query->whereBetween(
                                'birthday',
                                [$christmasDate->copy()->subYear(), $christmasDate->copy()]
                            ),
                            '1-2' => $query->whereBetween(
                                'birthday',
                                [$christmasDate->copy()->subYears(2), $christmasDate->copy()->subYear()]
                            ),
                            '3-4' => $query->whereBetween(
                                'birthday',
                                [$christmasDate->copy()->subYears(4), $christmasDate->copy()->subYears(3)]
                            ),
                            '5-6' => $query->whereBetween(
                                'birthday',
                                [$christmasDate->copy()->subYears(6), $christmasDate->copy()->subYears(5)]
                            ),
                            '7-8' => $query->whereBetween(
                                'birthday',
                                [$christmasDate->copy()->subYears(8), $christmasDate->copy()->subYears(7)]
                            ),
                            '9-10' => $query->whereBetween(
                                'birthday',
                                [$christmasDate->copy()->subYears(10), $christmasDate->copy()->subYears(9)]
                            ),
                            '10+' => $query->where('birthday', '<',
                                $christmasDate->copy()->subYears(10)
                            ),
                            default => $query
                        };
                    }),

                Tables\Filters\SelectFilter::make('gender')
                    ->label('Género')
                    ->options([
                        'female' => 'Femenino',
                        'male' => 'Masculino',
                        'other' => 'Otro',
                    ]),

                Tables\Filters\SelectFilter::make('sector_id')
                    ->label('Sector de residencia')
                    ->relationship('sector', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filtros'),
            )
            ->actions([
                Action::make('call')
                    ->label('Llamar')
                    ->tooltip('Llamar')
                    ->url(fn ($record) => sprintf('tel:%s', $record->phone))
                    ->color(Color::Indigo)
                    ->icon('fas-phone-volume')
                    ->iconButton(),
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->tooltip('Mensaje por WhatsApp')
                    ->url(fn ($record) => sprintf('https://wa.me/%s', $record->phone))
                    ->openUrlInNewTab()
                    ->color(Color::Emerald)
                    ->icon('fab-whatsapp')
                    ->iconButton(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
                    ->tooltip('Acciones')
                    ->color(Color::Red),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\ExportAction::make()
                    ->exporter(InscritoExporter::class)
                    ->label('Exportar Excel')
                    ->icon('far-file-excel')
                    ->color(Color::Emerald),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInscritos::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
