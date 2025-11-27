<?php

use Illuminate\Support\Carbon;
use Livewire\Volt\Component;

new class extends Component {
    public function getNewYear()
    {
        $current_year = Carbon::create(year: config('app.year'));

        return $current_year->addYear()->year;
    }
}; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 min-h-[80vh] gap-8">
    <div class="lg:grid place-content-center py-8 lg:px-8">
        <div class="bg-gradient-to-br from-transparent to-gray-300/5 backdrop-blur-xl lg:rounded-lg lg:shadow-lg p-6 text-center">
            <x-fas-star class="animate-pulse h-24 mx-auto text-yellow-500 mb-6" />

            <h1 class="text-4xl font-bold mb-4">#FelizNavidad</h1>

            <p class="text-lg mb-8 max-w-[48ch]">
                Feliz Navidad y un próspero {{ $this->getNewYear() }} les desea la Ilustre Municipalidad de Pichilemu.
            </p>

            <hr class="border-white/20 my-8">

            <p class="text-lg mb-8 max-w-[48ch]">
                Las inscripciones para la recepción de regalos navideños para la comuna de Pichilemu está disponible en el siguiente formulario.
            </p>

            <div class="mt-6">
                <a href="{{ route('inscribir') }}" class="bg-emerald-600/40 text-white py-3 px-6 rounded-lg hover:bg-emerald-600/80 transition inline-flex items-center space-x-2">
                    <x-fas-gift class="h-6" />
                    <span class="font-medium">Inscribir</span>
                </a>
            </div>
        </div>
    </div>
</div>
