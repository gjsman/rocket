<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Book;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => Assignment::class]);
    }

    public function show(Assignment $element): Factory|View|Application
    {
        return view('assignment.show', ['element' => $element]);
    }

    public function showPrevious(Assignment $element): Factory|View|Application
    {
        if(student()) {
            $submissions = $element->submissions->where('student_id', student());
        } else {
            $submissions = $element->submissions->where('user_id', Auth::id());
        }
        return view('assignment.previous', ['element' => $element, 'submissions' => $submissions]);
    }

    public function all(Assignment $element): Factory|View|Application
    {
        return view('assignment.all', ['element' => $element]);
    }

    public function showSubmission(AssignmentSubmission $element): Factory|View|Application
    {
        return view('assignment.showSubmission', ['element' => $element]);
    }

    public function edit(Assignment $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(Assignment $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
