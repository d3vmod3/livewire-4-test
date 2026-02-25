<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function ()
{
    Route::livewire('users', 'users');
    Route::livewire('/sample', 'pages::sample');
});

require __DIR__.'/settings.php';
