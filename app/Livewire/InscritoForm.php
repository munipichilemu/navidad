<?php

namespace App\Livewire;

use App\Models\Inscrito;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\View\View;
use Laragear\Rut\Rut;
use Livewire\Component;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class InscritoForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rut')
                    ->label('RUT')
                    ->rules(['rut', 'rut_unique:inscritos,rut_num,rut_vd'])
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => strlen($state) > 3
                        ? $set('rut', Rut::parse($state)->format())
                        : $state
                    )
                    ->formatStateUsing(fn (?string $state): string => $state ?? '')
                    ->validationAttribute('inscrito')
                    ->required(),

                Forms\Components\TextInput::make('names')
                    ->label('Nombres')
                    ->columnStart(1)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => strlen($state) > 3
                        ? $set('names', \Str::title($state))
                        : $state
                    )
                    ->formatStateUsing(fn (?string $state): string => $state ?? '')
                    ->required(),

                Forms\Components\TextInput::make('lastnames')
                    ->label('Apellidos')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => strlen($state) > 3
                        ? $set('lastnames', \Str::title($state))
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
                    ->required(),
            ])
            ->columns(2)
            ->statePath('data')
            ->model(Inscrito::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $inscrito = Inscrito::create($data);

        Notification::make()
            ->success()
            ->title('Inscripción realizada exitosamente')
            ->seconds(5)
            ->send();

        $this->redirect('/exitoso', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.inscrito-form');
    }
}
