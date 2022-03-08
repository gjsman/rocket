<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => Quiz::class]);
    }

    public function show(Quiz $element): Factory|View|Application
    {
        return view('quiz.show', ['element' => $element]);
    }

    public function showPrevious(Quiz $element): Factory|View|Application
    {
        if(student()) {
            $submissions = $element->submissions->where('student_id', student()->id);
        } else {
            $submissions = $element->submissions->where('user_id', Auth::id());
        }
        return view('quiz.previous', ['element' => $element, 'submissions' => $submissions]);
    }

    public function all(Quiz $element): Factory|View|Application
    {
        return view('quiz.all', ['element' => $element]);
    }

    public function showSubmission(QuizSubmission $element): Factory|View|Application
    {
        return view('quiz.showSubmission', ['element' => $element]);
    }

    public function edit(Quiz $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(Quiz $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
