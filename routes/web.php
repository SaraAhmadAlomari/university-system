<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StudentController;
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

            Route::get('parents', function () {
                return view('parents');
            });

            Route::resource('doctor', DoctorController::class);
            Route::get('/get-sections/{facultyId}', [SectionController::class, 'getSectionsByFaculty']);

            Route::resource('student', StudentController::class);
            Route::post('/attachments/{imageableId}/{imageableType}', [StudentController::class, 'upload_attachments'])->name('upload_attachments');
            Route::get('/attachments/{attachment}/download', [StudentController::class, 'download'])->name('images.download');
            Route::delete('/attachments/{attachment}', [StudentController::class, 'delete_image'])->name('images.delete_image');





        });

    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
