<?php

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

Route::prefix('academic-years')->group(function () {
    Route::get('/', 'AcademicYearController@index');                    // عرض جميع السنوات
    Route::post('/', 'AcademicYearController@store');                   // إنشاء سنة
    Route::get('/{id}', 'AcademicYearController@show');                 // عرض سنة واحدة
    Route::put('/{id}', 'AcademicYearController@update');               // تحديث سنة
    Route::delete('/{id}', 'AcademicYearController@destroy');           // حذف سنة
    Route::post('/{id}/activate', 'AcademicYearController@activate');   // تفعيل سنة
    Route::get('/active/current', 'AcademicYearController@getActiveYear'); // السنة المفعلة
});

// require __DIR__.'/auth.php';  ← 