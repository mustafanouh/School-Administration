<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسارات السنوات الدراسية التي أضافها زميلك
Route::prefix('academic-years')->group(function () {
    Route::get('/', 'AcademicYearController@index');
    Route::post('/', 'AcademicYearController@store');
    Route::get('/{id}', 'AcademicYearController@show');
    Route::put('/{id}', 'AcademicYearController@update');
    Route::delete('/{id}', 'AcademicYearController@destroy');
    Route::post('/{id}/activate', 'AcademicYearController@activate');
    Route::get('/active/current', 'AcademicYearController@getActiveYear');
});


Route::resource('employees', EmployeeController::class);













require __DIR__ . '/auth.php';
