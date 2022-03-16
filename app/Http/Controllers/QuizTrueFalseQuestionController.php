<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Quiz;
use App\Models\QuizTrueFalseQuestion;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizTrueFalseQuestionController extends Controller
{
    public function create(Quiz $quiz): Factory|View|Application
    {
        return view('course.edit-element', ['quiz' => $quiz, 'class' => QuizTrueFalseQuestion::class]);
    }

    public function edit(QuizTrueFalseQuestion $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(QuizTrueFalseQuestion $element): RedirectResponse
    {
        $quiz = $element->quiz;
        $element->delete();
        return redirect()->route('quiz', ['quiz' => $quiz]);
    }
}
