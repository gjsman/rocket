<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CanEdit
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
        $course = $request->route()->parameter('course');
        $enrollment = $request->route()->parameter('enrollment');

        if ($section) {
            $course = $section->course;
        } elseif ($element) {
            try {
                $course = $element->section->course;
            } catch (\ErrorException) {
                $course = $element->parent->section->course;
            }
        } elseif ($course) {
            // $course = $course already, just don't go through the else
        } elseif ($enrollment) {
            $course = $enrollment->course;
        } else {
            return redirect()->route('dashboard');
        }

        if (!$request->user()) return redirect()->route('shop.show', $course);

        if($section) {
            if ($request->user()->cannot('update', $section)) return redirect()->route('course', $course);
        } elseif($element) {
            if ($request->user()->cannot('update', $element)) return redirect()->route('course', $course);
        } elseif($course) {
            if ($request->user()->cannot('update', $course)) return redirect()->route('course', $course);
        }

        return $next($request);
    }
}
