<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Link;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => File::class]);
    }

    public function show(File $element): RedirectResponse
    {
        return redirect()->to(Storage::url($element->file));
    }

    public function edit(File $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(File $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
