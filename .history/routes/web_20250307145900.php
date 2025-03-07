<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FeeHeadController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignSubjectToClassController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignTeacherToClassController;

Route::get('/', function () {
    return view('welcome');
});

// Teacher Routes
Route::group(['prefix' => 'teacher'], function () {
    Route::group(['middleware' => 'teacher.guest'], function () {
        Route::get('login', [TeacherController::class, 'login'])->name('teacher.login');
        Route::post('authenticate', [TeacherController::class, 'authenticate'])->name('teacher.authenticate');
    });

    Route::group(['middleware' => 'teacher.auth'], function () {
        Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        Route::get('logout', [TeacherController::class, 'logout'])->name('teacher.logout');
    });
});

// Student Routes
Route::group(['prefix' => 'student'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [UserController::class, 'index'])->name('student.login');
        Route::post('authenticate', [UserController::class, 'authenticate'])->name('student.authenticate');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('student.dashboard');
        Route::get('logout', [UserController::class, 'logout'])->name('student.logout');
        Route::get('change-password', [UserController::class, 'changePassword'])->name('student.changePassword');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('student.updatePassword');
    });
});

// Admin Routes
Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('login', [AdminController::class, 'index'])->name('admin.login');
    Route::get('register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
});

Route::group(['middleware' => 'admin.auth'], function () {
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('form', [AdminController::class, 'form'])->name('admin.form');
    Route::get('table', [AdminController::class, 'table'])->name('admin.table');

    // Academic Year Management
    Route::get('academic-year/create', [AcademicYearController::class, 'index'])->name('academic-year.create');
    Route::post('academic-year/store', [AcademicYearController::class, 'store'])->name('academic-year.store');
    Route::get('academic-year/read', [AcademicYearController::class, 'read'])->name('academic-year.read');
    Route::get('academic-year/delete/{id}', [AcademicYearController::class, 'delete'])->name('academic-year.delete');
    Route::get('academic-year/edit/{id}', [AcademicYearController::class, 'edit'])->name('academic-year.edit');
    Route::post('academic-year/update', [AcademicYearController::class, 'update'])->name('academic-year.update');

    // Announcement Management
    Route::resource('announcement', AnnouncementController::class)->except(['show']);

    // Class Management
    Route::resource('class', ClassesController::class)->except(['show']);

    // Subject Management
    Route::resource('subject', SubjectController::class)->except(['show']);

    // Assign Subject to Class
    Route::resource('assign-subject', AssignSubjectToClassController::class)->except(['show']);

    // Teacher Management
    Route::resource('teacher', TeacherController::class)->except(['show']);

    // Assign Teacher to Class
    Route::get('assign-teacher/create', [AssignTeacherToClassController::class, 'index'])->name('assign-teacher.create');
    Route::post('assign-teacher/store', [AssignTeacherToClassController::class, 'store'])->name('assign-teacher.store');
    Route::get('assign-teacher/read', [AssignTeacherToClassController::class, 'read'])->name('assign-teacher.list');
    Route::get('assign-teacher/read/{id}', [AssignTeacherToClassController::class, 'read'])->name('assign-teacher.read');
    Route::get('findSubject', [AssignTeacherToClassController::class, 'findSubject'])->name('findSubject');

    // Fees Management
    Route::resource('fee-head', FeeHeadController::class)->except(['show']);

    // Fee Structure Management
    Route::get('fee-structure/create', [FeeStructureController::class, 'index'])->name('fee-structure.create');
    Route::post('fee-structure/store', [FeeStructureController::class, 'store'])->name('fee-structure.store');
    Route::get('fee-structure/read', [FeeStructureController::class, 'read'])->name('fee-structure.read');
    Route::get('fee-structure/delete/{id}', [FeeStructureController::class, 'delete'])->name('fee-structure.delete');
    Route::get('fee-structure/edit/{id}', [FeeStructureController::class, 'edit'])->name('fee-structure.edit');
    Route::post('fee-structure/update/{id}', [FeeStructureController::class, 'update'])->name('fee-structure.update');

    // Student Management
    Route::resource('student', StudentController::class)->except(['show']);
});