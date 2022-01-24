<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookPageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TextBlockController;
use App\Http\Controllers\VideoController;
use App\Models\Assignment;
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
    Route::get('/orders', [ShopController::class, 'orders'])->name('orders');
    Route::get('/cart/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('/cart/checkout/completed', [ShopController::class, 'checkoutCompleted'])->name('checkoutCompleted');

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
    Route::middleware(['canEdit'])->group(function () {
        Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
        Route::get('/course/move/{course}/{class}/{id}', [ElementController::class, 'move'])->name('element.move');
        Route::post('/course/move/{course}/{class}/{id}', [ElementController::class, 'move'])->name('element.move');
        Route::get('/course/duplicate/{course}/{class}/{id}', [ElementController::class, 'duplicate'])->name('element.duplicate');
        Route::post('/course/duplicate/{course}/{class}/{id}', [ElementController::class, 'duplicate'])->name('element.duplicate');
    });

    Route::middleware(['canView'])->group(function () {
        /** Course */
        Route::get('/course/{course}', [CourseController::class, 'index'])->name('course');
        Route::get('/course/{course}/{location}', [CourseController::class, 'location'])->name('course.location');

        /** Elements */
        Route::get('/video/{element}', [VideoController::class, 'show'])->name('video');
        Route::get('/link/{element}', [LinkController::class, 'show'])->name('link');
        Route::get('/file/{element}', [FileController::class, 'show'])->name('file');
        Route::get('/book/{element}', [BookController::class, 'show'])->name('book');
        Route::get('/assignment/{element}', [AssignmentController::class, 'show'])->name('assignment');
        Route::get('/assignment/{element}/previous', [AssignmentController::class, 'showPrevious'])->name('assignment.previous');
        Route::get('/quiz/{element}', [QuizController::class, 'show'])->name('quiz');
        Route::get('/forum/{element}', [ForumController::class, 'show'])->name('forum');
    });

    Route::middleware(['canEdit'])->group(function () {
        /** Sections */
        Route::get('/section/edit/{section}', [CourseController::class, 'editSection'])->name('section.edit');
        Route::get('/section/delete/{section}', [CourseController::class, 'deleteSection'])->name('section.delete');

        /** Videos */
        Route::get('/video/create/{section}', [VideoController::class, 'create'])->name('video.create');
        Route::get('/video/{element}/edit', [VideoController::class, 'edit'])->name('video.edit');
        Route::get('/video/{element}/delete', [VideoController::class, 'delete'])->name('video.delete');

        /** Links */
        Route::get('/link/create/{section}', [LinkController::class, 'create'])->name('link.create');
        Route::get('/link/{element}/edit', [LinkController::class, 'edit'])->name('link.edit');
        Route::get('/link/{element}/delete', [LinkController::class, 'delete'])->name('link.delete');

        /** Text Blocks */
        Route::get('/textBlock/create/{section}', [TextBlockController::class, 'create'])->name('textblock.create');
        Route::get('/textBlock/{element}/edit', [TextBlockController::class, 'edit'])->name('textblock.edit');
        Route::get('/textBlock/{element}/delete', [TextBlockController::class, 'delete'])->name('textblock.delete');

        /** Files */
        Route::get('/file/create/{section}', [FileController::class, 'create'])->name('file.create');
        Route::get('/file/{element}/edit', [FileController::class, 'edit'])->name('file.edit');
        Route::get('/file/{element}/delete', [FileController::class, 'delete'])->name('file.delete');

        /** Books */
        Route::get('/book/create/{section}', [BookController::class, 'create'])->name('book.create');
        Route::get('/book/{element}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::get('/book/{element}/delete', [BookController::class, 'delete'])->name('book.delete');
        Route::get('/book/{element}/{location}', [BookController::class, 'location'])->name('book.location');

        /** Book Pages */
        Route::get('/bookPage/edit/{element}', [BookPageController::class, 'edit'])->name('bookpage.edit');
        Route::get('/bookPage/delete/{element}', [BookPageController::class, 'delete'])->name('bookpage.delete');

        /** Assignments */
        Route::get('/assignment/create/{section}', [AssignmentController::class, 'create'])->name('assignment.create');
        Route::get('/assignment/{element}/edit', [AssignmentController::class, 'edit'])->name('assignment.edit');
        Route::get('/assignment/{element}/delete', [AssignmentController::class, 'delete'])->name('assignment.delete');
        Route::get('/assignment/{element}/all', [AssignmentController::class, 'all'])->name('assignment.all');

        /** Quizzes */
        Route::get('/quiz/create/{section}', [QuizController::class, 'create'])->name('quiz.create');
        Route::get('/quiz/{element}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
        Route::get('/quiz/{element}/delete', [QuizController::class, 'delete'])->name('quiz.delete');

        /** Forums */
        Route::get('/forum/create/{section}', [ForumController::class, 'create'])->name('forum.create');
        Route::get('/forum/{element}/edit', [ForumController::class, 'edit'])->name('forum.edit');
        Route::get('/forum/{element}/delete', [ForumController::class, 'delete'])->name('forum.delete');
    });
});


Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{course}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/shop/{course}/addToCart', [ShopController::class, 'addToCart'])->name('shop.addToCart');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');
Route::get('/instructor/{instructor}', [InstructorController::class, 'show'])->name('instructor');
/** Only enrolled can see these routes. */
Route::middleware(['enrolled'])->group(function () {
    // Route::get('/course/{course}', [CourseController::class, 'index'])->name('course');
});
