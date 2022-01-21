<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Section;
use App\Models\TextBlock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TextBlockController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => TextBlock::class]);
    }

    public function show(TextBlock $element): RedirectResponse
    {
        return Redirect::to($element->url);
    }

    public function edit(TextBlock $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(TextBlock $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
