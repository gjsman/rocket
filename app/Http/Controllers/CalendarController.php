<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index() {
        $students = [];
        if(!student()) {
            foreach (Auth::user()->students as $student) {
                $students[] = $student;
            }
        } else {
            $students[] = student();
        }

        $assignments = [];
        $quizzes = [];
        foreach($students as $student) {
            foreach($student->courses as $course) {
                foreach($course->sections as $section) {
                    foreach($section->assignments as $assignment) {
                        if($assignment->due)
                            $assignments[] = $assignment;
                    }
                    foreach($section->quizzes->where('due', '<=', Carbon::now()->addDays(14)->toDateTimeString())->sortBy('due') as $quiz) {
                        if($quiz->due)
                            $quizzes[] = $quiz;
                    }
                }
            }
        }

        return view('calendar.index', ['assignments' => $assignments, 'quizzes' => $quizzes]);
    }
}
