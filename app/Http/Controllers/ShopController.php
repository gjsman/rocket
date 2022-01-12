<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(): Factory|View|Application {
        return view('shop.index');
    }

    public function show(Course $course): Factory|View|Application
    {
        if(!$course->visible) {
            if(!Auth::check()) abort(401);
            if((Auth::user()->rank < 5) && (Auth::id() !== $course->instructor_id)) abort(403);
        }
        return view('course.guest', ['course' => $course]);
    }
}
