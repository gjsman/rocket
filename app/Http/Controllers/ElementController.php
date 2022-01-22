<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use Carbon\Carbon;
use Error;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ElementController extends Controller
{
    public function move(Course $course, string $class, int $id, Request $request): View|Factory|RedirectResponse|Application
    {
        if ($request->method() === 'GET') {
            try {
                $className = '\\App\\Models\\'.$class;
                $element = $className::where('id', $id)->first();
                if($element) {
                    if($element->section->course->id === $course->id) {
                        return view('course.move-element', ['course' => $course, 'element' => $element]);
                    }
                }
            } catch (Error) {

            }
        } elseif ($request->method() === 'POST') {
            try {
                $className = '\\App\\Models\\'.$class;
                $element = $className::where('id', $id)->first();
                if($element) {
                    if($element->section->course->id === $course->id) {
                        // return view('course.move-element', ['course' => $course, 'element' => $element]);
                        if(request('sectionID')) {
                            $request->validate([
                                'sectionID' => 'required|numeric',
                            ]);
                            $newSection = Section::where('id', request('sectionID'))->first();
                            if ($newSection) {
                                if (Auth::user()->can('update', $element) && Auth::user()->can('update', $newSection)) {
                                    $element->section_id = $newSection->id;
                                    $element->order = 0;
                                    $element->save();
                                    return redirect()->route('course.location', ['course' => $course, 'location' => $newSection]);
                                }
                            }
                        }
                    }
                }
            } catch (Error) {

            }
        }
        return redirect()->route('course', ['course' => $course]);
    }

    public function duplicate(Course $course, string $class, int $id, Request $request): View|Factory|RedirectResponse|Application
    {
        if ($request->method() === 'GET') {
            try {
                $className = '\\App\\Models\\'.$class;
                $element = $className::where('id', $id)->first();
                if($element) {
                    if($element->section->course->id === $course->id) {
                        return view('course.duplicate-element', ['course' => $course, 'element' => $element]);
                    }
                }
            } catch (Error) {

            }
        } elseif ($request->method() === 'POST') {
            try {
                $className = '\\App\\Models\\'.$class;
                $element = $className::where('id', $id)->first();
                if($element) {
                    if($element->section->course->id === $course->id) {
                        // return view('course.move-element', ['course' => $course, 'element' => $element]);
                        if(request('sectionID')) {
                            $request->validate([
                                'sectionID' => 'required|numeric',
                            ]);
                            $newSection = Section::where('id', request('sectionID'))->first();
                            if ($newSection) {
                                if (Auth::user()->can('update', $element) && Auth::user()->can('update', $newSection)) {
                                    $newElement = $element->replicate();
                                    $newElement->name = $newElement->name." (duplicate)";
                                    $newElement->created_at = Carbon::now();
                                    $newElement->section_id = $newSection->id;
                                    $newElement->order = 0;
                                    $newElement->save();
                                    return redirect()->route('course.location', ['course' => $course, 'location' => $newSection]);
                                }
                            }
                        }
                    }
                }
            } catch (Error) {

            }
        }
        return redirect()->route('course', ['course' => $course]);
    }
}
