<?php

use App\Livewire\Users\Create as UsersCreate;

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Users\Index as UsersIndex;
use App\Livewire\Users\Update as UserUpdate;
use App\Livewire\Vehicles\Index as VehiclesIndex;
use App\Livewire\Vehicles\Create as VehiclesCreate;
use App\Livewire\Vehicles\Update as VehiclesUpdate;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

//Usuarios
Route::get('users', UsersIndex::class)->name("users.index");
Route::get('users/create', UsersCreate::class)->name('users.create');
Route::get('users/{user}/edit', UserUpdate::class)->name('users.edit');

//Vehiculos

Route::get('vehicles', VehiclesIndex::class)->name("vehicles.index");
Route::get('vehicles/create', VehiclesCreate::class)->name('vehicles.create');
Route::get('vehicles/{vehicle}/edit', VehiclesUpdate::class)->name('vehicles.edit');