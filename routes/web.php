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
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Portal\PortalController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PortalController::class)->group(function () {
    Route::get('/portal', 'index')->name('portal.index');
    Route::get('/portal/marks', 'marks')->name('portal.marks');
    Route::get('/portal/attendance', 'attendance')->name('portal.attendance');
    Route::view('portal/contact', 'portal.contact')->name('portal.contact');
});

Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::get('/profile/{user}', 'show')->name('profile.show');
    });

    // Admin 
    Route::middleware(['role:admin'])->group(function () {
        Route::patch('employees/{employee}/update-photo', [EmployeeController::class, 'updatePhoto'])
            ->name('employees.updatePhoto');
        Route::resources([
            'employees'      => EmployeeController::class,
            'sections'       => SectionController::class,
            'teachers'       => TeacherController::class,
            'academic_years' => AcademicYearController::class,
            'semesters'      => SemesterController::class,
        ]);

        Route::get('statistics/chart', [StatisticsController::class, 'showCharts'])->name('stats.chart');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/security/access-control', [RolePermissionController::class, 'index'])->name('access.index');
            Route::post('/security/access-control/{user}/sync', [RolePermissionController::class, 'syncUserAccess'])->name('sync-access');
        });
    });

    // Admin + Secretary
    Route::middleware(['role:admin|secretary|student'])->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('enrollments', EnrollmentController::class);

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
    });

    // Admin + Teacher
    Route::middleware(['role:admin|teacher'])->group(function () {
        Route::resources([
            'exams'            => ExamController::class,
            'marks'            => MarkController::class,
            'teacher_subjects' => TeacherSubjectController::class,
        ]);
    });

    // Admin + Supervisor
    Route::middleware(['role:admin|supervisor'])->group(function () {
        Route::controller(AttendanceController::class)->group(function () {
            Route::get('/attendance/sections', 'index')->name('attendance.sections.index');
            Route::get('/attendance/section/{id}', 'showSectionAttendance')->name('attendance.section');
            Route::post('/attendance/student/store', 'storeStudentAttendance')->name('attendance.student.store');
            Route::get('/attendance/staff', 'showStaffAttendance')->name('attendance.staff.show');
            Route::post('/attendance/staff/store', 'storeStaffAttendance')->name('attendance.staff.store');
        });
    });

    // chat
    Route::middleware(['role:admin|secretary|supervisor|teacher'])->group(function () {
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        Route::get('/messages/{receiverId}', [ChatController::class, 'getMessages'])->name('chat.messages');
        Route::post('/send-message', [ChatController::class, 'store'])->name('chat.send');
    });

    // search
    Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('search.global');


    // notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
});




require __DIR__ . '/auth.php';
