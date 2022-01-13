<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CanViewCourse
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
        if (!$request->user()) return redirect()->route('shop.show', $course);
        if ($request->user()->cannot('view', $course)) return redirect()->route('shop.show', $course);
        return $next($request);
    }
}
