<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
use App\Http\Controllers\StatisticsController;
use App\Models\Student;
use App\Http\Controllers\SearchController;

use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});





Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::get('/profile/{user}', 'show')->name('profile.show');
    });
    // School Resources
    Route::resources([
        'employees' => EmployeeController::class,
        'teachers' => TeacherController::class,
        'students' => StudentController::class,
        'sections' => SectionController::class,
        'enrollments' => EnrollmentController::class,
        'exams' => ExamController::class,
        'marks' => MarkController::class,
        'academic_years' => AcademicYearController::class,
        'semesters' => SemesterController::class,
        'teacher_subjects' => TeacherSubjectController::class,
    ]);
    // chart
    Route::get('statistics/chart', [StatisticsController::class, 'getEnrollmentStats'])
        ->name('stats.chart');

    // reveb route
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{receiverId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/send-message', [ChatController::class, 'store'])->name('chat.send');

    // enrollment stats
    Route::get('/api/students/{student}/previous-info', function (Student $student) {

        $lastEnrollment = $student->enrollments()->with(['section', 'academicYear'])->latest()->first();

        return response()->json([
            'has_previous' => (bool)$lastEnrollment,
            'status' => $lastEnrollment?->status ?? 'N/A',
            'grade' => $lastEnrollment?->section->grade->name ?? 'N/A',
            'year' => $lastEnrollment?->academicYear?->name ?? 'N/A',
        ]);
    })->name('api.student.previous-info');

    // fore search route
    Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('search.global');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/security/access-control', [RolePermissionController::class, 'index'])
        ->name('access.index');

    Route::post('/security/access-control/{user}/sync', [RolePermissionController::class, 'syncUserAccess'])
        ->name('sync-access');
});


















// Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
//                 ->name('logout');
require __DIR__ . '/auth.php';
