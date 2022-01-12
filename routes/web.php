<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{course}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');

/** Only logged in and verified users can see these routes. */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/student/unset', [StudentController::class, 'unset'])->name('student.unset');
    Route::get('/student/{student}', [StudentController::class, 'set'])->name('student.set');

    Route::get('/students', function() {
        return view('student.index');
    })->name('students.manage');

    /** Only students can see these routes. */
    Route::middleware(['student'])->group(function () {

    });

    /** Only parents can see these routes. */
    Route::middleware(['parent'])->group(function () {

    });

    /** Only admins can see these routes. */
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
        Route::get('/admin/instructors', [AdminController::class, 'instructors'])->name('admin.instructors');
    });
});

/** Only enrolled can see these routes. */
Route::middleware(['enrolled'])->group(function () {
    Route::get('/course/{course}', [CourseController::class, 'index'])->name('course');
});
