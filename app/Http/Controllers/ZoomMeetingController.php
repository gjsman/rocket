<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Section;
use App\Models\ZoomMeeting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ZoomMeetingController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => ZoomMeeting::class]);
    }

    public function edit(ZoomMeeting $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(ZoomMeeting $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
