<?php

use App\Livewire\InscritoForm;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'welcome')->name('home');
Route::get('/inscribir', InscritoForm::class)->name('inscribir');
Volt::route('/exitoso', 'exitoso');
