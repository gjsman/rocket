<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Student;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Enrolled
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $course = $request->route()->parameter('course');
        // We don't need to check if this course exists here, other middleware ensures it does.

        /** Check if user is logged in. */
        if (!Auth::check()) return $this->unauthorized($course);

        /** Check if user is admin. */
        if (Auth::user()->rank >= 5) return $next($request);

        /** Check if user is instructor. */
        if (Auth::id() === $course->instructor_id) return $next($request);

        /** Check if the course is visible before proceeding. */
        if(!$course->visible) return $this->unauthorized($course);

        /** Check if student is enrolled. */
        if (session('student') === NULL) return $this->unauthorized($course);
        $student = Cache::driver('array')->rememberForever('student', function (): ?Student {
            return Student::where('id', session('student'))->where('user_id', Auth::id())->first();
        });
        if (is_null($student)) return $this->unauthorized($course);
        if ($student->enrolled($course) && Auth::user()->sparkPlan()) return $next($request);
        return $this->unauthorized($course);
    }

    public function unauthorized(Course $course): RedirectResponse
    {
        /** Redirect to the Shop page if unauthorized. */
        return redirect()->route('shop.show', $course);
    }
}
