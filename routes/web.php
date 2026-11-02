<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturerCourseController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |------------------------------------------------------------------
    | Courses
    |------------------------------------------------------------------
    | Reading is open to any role with 'view courses'; writing is
    | administrator-only. The show route is constrained to numbers so
    | that /courses/create is not swallowed by /courses/{course}.
    */
    Route::middleware('permission:view courses')->group(function () {
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{course}', [CourseController::class, 'show'])
            ->whereNumber('course')
            ->name('courses.show');
    });

    /*
    |------------------------------------------------------------------
    | A lecturer's assigned courses
    |------------------------------------------------------------------
    */
    Route::middleware('permission:view assigned courses')->group(function () {
        Route::get('/teaching', [LecturerCourseController::class, 'index'])->name('teaching.index');
    });

    Route::middleware('permission:view course students')->group(function () {
        Route::get('/teaching/{course}', [LecturerCourseController::class, 'show'])
            ->whereNumber('course')
            ->name('teaching.show');
    });

    /*
    |------------------------------------------------------------------
    | A student's own registrations
    |------------------------------------------------------------------
    | Middleware decides whether a student may unregister at all; the
    | CourseRegistrationPolicy decides whose registration it is.
    */
    Route::middleware('permission:view own registrations')->group(function () {
        Route::get('/my/courses', [MyCourseController::class, 'index'])->name('my.courses');
    });

    Route::middleware('permission:register courses')->group(function () {
        Route::post('/my/courses', [MyCourseController::class, 'store'])->name('my.courses.store');
        Route::delete('/my/courses/{registration}', [MyCourseController::class, 'destroy'])
            ->name('my.courses.destroy');
    });

    /*
    |------------------------------------------------------------------
    | Students — administrator only
    |------------------------------------------------------------------
    */
    Route::middleware('permission:manage students')->group(function () {
        Route::resource('students', StudentController::class);
    });

    /*
    |------------------------------------------------------------------
    | All registrations — administrator only
    |------------------------------------------------------------------
    */
    Route::middleware('permission:manage registrations')->group(function () {
        Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
        Route::get('/registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
        Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
        Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])
            ->name('registrations.destroy');
    });

    Route::middleware('permission:manage courses')->group(function () {
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });
});

require __DIR__.'/auth.php';
