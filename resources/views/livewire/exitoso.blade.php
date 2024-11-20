<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 min-h-[80vh] gap-8">
    <div class="lg:grid place-content-center py-8 lg:px-8">
        <div class="bg-gradient-to-br from-transparent to-gray-300/5 backdrop-blur-xl lg:rounded-lg lg:shadow-lg p-6 text-center">
            <x-fas-circle-check class="h-24 w-24 mx-auto text-emerald-600/60 mb-6" />

            <h2 class="text-3xl font-bold mb-4">¡Registro exitoso!</h2>
            <p class="text-lg mb-8">Tu inscripción ha sido registrada correctamente.</p>

            <p class="text-sm max-w-[48ch] mb-8">Para más novedades sobre las fechas de entrega de regalos visite el sitio web de la Municipalidad o sus redes sociales:</p>

            <ul class="text-sm grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
                <li>
                    <a href="https://pichilemu.cl" class="py-3 px-4 rounded-lg hover:bg-cyan-500/60 w-full transition">
                        <x-fas-arrow-pointer class="inline-block align-bottom h-5"/> pichilemu.cl
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/MuniPichilemu/" class="py-3 px-4 rounded-lg hover:bg-blue-500/60 w-full transition">
                        <x-fab-facebook class="inline-block align-bottom h-5"/> Facebook
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/muni_pichilemu/" class="py-3 px-4 rounded-lg hover:bg-purple-500/60 w-full transition">
                        <x-fab-instagram class="inline-block align-bottom h-5"/> Instagram
                    </a>
                </li>
            </ul>

            <div class="mt-6 grid gap-4">
                <a href="/" class="bg-emerald-600/40 text-white py-3 px-4 rounded-lg hover:bg-emerald-600/80 transition inline-flex items-center justify-center">
                    <x-fas-home class="h-6 inline-block align-top mr-2" />
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>
