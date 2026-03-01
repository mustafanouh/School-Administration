<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Models\User;

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



Route::resource('employees', EmployeeController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);
Route::resource('sections', SectionController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::resource('exams', ExamController::class);
Route::resource('marks', MarkController::class);
Route::resource('academic_years', AcademicYearController::class);
Route::resource('semesters', SemesterController::class);
Route::resource('teacher_subjects', TeacherSubjectController::class);







    
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{receiverId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/send-message', [ChatController::class, 'store'])->name('chat.send');













require __DIR__ . '/auth.php';
