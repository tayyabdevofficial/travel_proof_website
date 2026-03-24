<?php

use App\Livewire\Settings\Password;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('settings/password', Password::class)->name('user-password.edit');
});
