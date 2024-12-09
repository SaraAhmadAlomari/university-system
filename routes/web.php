<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware(['auth', 'verified'])->group(function () {

            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            Route::resource('faculty', FacultyController::class);
            Route::resource('classroom', ClassroomController::class);
            Route::resource('section', SectionController::class);
            //get classrooms 
            Route::get('/faculty/{id}/classrooms', [FacultyController::class, 'getClassrooms']);



        });

    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
