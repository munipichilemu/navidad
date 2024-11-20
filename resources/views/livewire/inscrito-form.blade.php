<div class="grid grid-cols-1 lg:grid-cols-2 min-h-[80vh] gap-8">
    <div class="lg:grid place-content-center py-8 lg:px-8">
        <h2 class="text-3xl font-bold mb-6 lg:pl-6 text-center lg:text-left">Ficha de inscripción</h2>
        <div class="bg-gradient-to-br from-transparent to-gray-300/5 backdrop-blur-xl lg:rounded-lg lg:shadow-lg p-6">
            <form wire:submit="create" id="inscripcion">
                {{ $this->form }}

                <div class="mt-12 grid grid-cols-3 gap-4">
                    <button type="reset" class="bg-gray-500/20 text-white py-1 px-3 rounded-lg hover:bg-gray-500/60 transition">
                        <x-fas-backspace class="h-6 inline-block align-top" />
                        Limpiar
                    </button>

                    <button type="submit" class="col-start-3 bg-emerald-600/40 text-white py-1 px-3 rounded-lg hover:bg-emerald-600/80 transition">
                        <x-fas-check class="h-6 inline-block align-top" />
                        Inscribir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-filament-actions::modals />
</div>
