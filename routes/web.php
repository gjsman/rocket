<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TextBlockController;
use App\Http\Controllers\VideoController;
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

/** Only logged in and verified users can see these routes. */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/student/unset', [StudentController::class, 'unset'])->name('student.unset');
    Route::get('/student/{student}', [StudentController::class, 'set'])->name('student.set');

    Route::get('/students', function() {
        return view('student.index');
    })->name('students.manage');

    Route::get('/course/{course}/enroll/{student}', [CourseController::class, 'enroll'])->name('course.enroll');
    Route::get('/course/{course}/unenroll/{student}', [CourseController::class, 'unenroll'])->name('course.unenroll');

    /** Only students can see these routes. */
    Route::middleware(['student'])->group(function () {

    });

    /** Only parents can see these routes. */
    Route::middleware(['parent'])->group(function () {

    });

    /** Only admins can see these routes. */
    Route::middleware(['admin'])->group(function () {

    });

    Route::middleware(['canViewCourse'])->group(function () {
        Route::get('/course/{course}', [CourseController::class, 'index'])->name('course');
        Route::get('/course/{course}/{location}', [CourseController::class, 'location'])->name('course.location');

        Route::get('/video/{element}', [VideoController::class, 'show'])->name('video');
        Route::get('/link/{element}', [LinkController::class, 'show'])->name('link');
        Route::get('/file/{element}', [FileController::class, 'show'])->name('file');
        Route::get('/book/{element}', [BookController::class, 'show'])->name('book');
        Route::get('/book/{element}/{location}', [BookController::class, 'location'])->name('book.location');
    });

    Route::middleware(['canEditCourse'])->group(function () {
        Route::get('/section/edit/{section}', [CourseController::class, 'editSection'])->name('section.edit');
        Route::get('/section/delete/{section}', [CourseController::class, 'deleteSection'])->name('section.delete');

        Route::get('/video/create/{section}', [VideoController::class, 'create'])->name('video.create');
        Route::get('/video/{element}/edit', [VideoController::class, 'edit'])->name('video.edit');
        Route::get('/video/{element}/delete', [VideoController::class, 'delete'])->name('video.delete');

        Route::get('/link/create/{section}', [LinkController::class, 'create'])->name('link.create');
        Route::get('/link/{element}/edit', [LinkController::class, 'edit'])->name('link.edit');
        Route::get('/link/{element}/delete', [LinkController::class, 'delete'])->name('link.delete');

        Route::get('/textBlock/create/{section}', [TextBlockController::class, 'create'])->name('textblock.create');
        Route::get('/textBlock/{element}/edit', [TextBlockController::class, 'edit'])->name('textblock.edit');
        Route::get('/textBlock/{element}/delete', [TextBlockController::class, 'delete'])->name('textblock.delete');

        Route::get('/file/create/{section}', [FileController::class, 'create'])->name('file.create');
        Route::get('/file/{element}/edit', [FileController::class, 'edit'])->name('file.edit');
        Route::get('/file/{element}/delete', [FileController::class, 'delete'])->name('file.delete');

        Route::get('/book/create/{section}', [BookController::class, 'create'])->name('book.create');
        Route::get('/book/{element}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::get('/book/{element}/delete', [BookController::class, 'delete'])->name('book.delete');
    });
});


Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{course}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');

/** Only enrolled can see these routes. */
Route::middleware(['enrolled'])->group(function () {
    // Route::get('/course/{course}', [CourseController::class, 'index'])->name('course');
});
