<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CanEditCourse
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
        $section = $request->route()->parameter('section');
        $element = $request->route()->parameter('element');

        if($section) {
            $course = $section->course;
        } elseif($element) {
            $course = $element->section->course;
        } else {
            return redirect()->route('dashboard');
        }

        if (!$request->user()) return redirect()->route('shop.show', $course);

        if($section) {
            if ($request->user()->cannot('update', $section)) return redirect()->route('course', $course);
        } elseif($element) {
            if ($request->user()->cannot('update', $element)) return redirect()->route('course', $course);
        }

        return $next($request);
    }
}
