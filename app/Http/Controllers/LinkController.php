<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Section;
use App\Models\Video;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => Link::class]);
    }

    public function show(Link $element): RedirectResponse
    {
        return Redirect::to($element->url);
    }

    public function edit(Link $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(Link $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
