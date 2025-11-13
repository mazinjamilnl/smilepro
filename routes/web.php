<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TandartsController;
use App\Http\Controllers\MondhygienistController;
use App\Http\Controllers\AssistentController;
use App\Http\Controllers\PraktijkmanagementController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/patient', [PatientController::class, 'index'])
//             ->name('patient.index')
//             ->middleware(['auth','role:patient,praktijkmanagement']);

Route::get('/tandarts', [TandartsController::class, 'index'])
            ->name('tandarts.index')
            ->middleware(['auth','role:tandarts']);
           // ->middleware(['auth','role:tandarts,praktijkmanagement']);

// Route::get('/mondhygienist', [MondhygienistController::class, 'index'])
//             ->name('mondhygienist.index')
//             ->middleware(['auth','role:mondhygienist,praktijkmanagement']);

// Route::get('/assistent', [AssistentController::class, 'index'])
//             ->name('assistent.index')
//             ->middleware(['auth','role:assistent,praktijkmanagement']);

// Route::get('/praktijkmanagement', [PraktijkmanagementController::class, 'index'])
//             ->name('praktijkmanagement.index')
//             ->middleware(['auth','role:praktijkmanagement']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
