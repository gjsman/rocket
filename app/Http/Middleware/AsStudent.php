<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AsStudent
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
        if(!Auth::check()) abort(401);
        if(session('student') === NULL) abort(403);
        $student = Cache::driver('array')->rememberForever('student_'.session('student'), function(): ?Student {
            return Student::where('id', session('student'))->where('user_id', Auth::id())->first();
        });
        if(is_null($student)) abort(403);
        $request->attributes->add(['student' => $student]);
        return $next($request);
    }
}
