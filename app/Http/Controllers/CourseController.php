<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\Section;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Course $course): Factory|View|Application|RedirectResponse
    {
        $location = $this->getLocation($course);
        return view('course.index', ['course' => $course, 'location' => $location]);
    }

    public function location(Course $course, string $location): RedirectResponse
    {
        if(is_numeric($location)) {
            if(Section::where('course_id', $course->id)->where('id', $location)->exists()) {
                $this->setLocation($course, $location);
            } else {
                $this->setLocation($course, 'information');
            }
        } elseif ($location === 'information' || $location === 'participants' || $location === 'completion') {
            $this->setLocation($course, $location);
        } else {
            $this->setLocation($course, 'information');
        }
        return redirect()->route('course', $course);
    }

    private function setLocation(Course $course, string $location): void
    {
        $progress = $this->getProgressFromDatabase($course);
        if($progress === NULL) {
            $progress = new CourseProgress;
            $progress->course_id = $course->id;
            if(student()) {
                $progress->student_id = student()->id;
            } else {
                $progress->user_id = Auth::id();
            }
            $progress->location = $location;
            $progress->save();
        } else {
            $progress->location = $location;
            $progress->save();
        }
    }

    private function getLocation(Course $course): string
    {
        $progress = $this->getProgressFromDatabase($course);
        if($progress === NULL) {
            $this->setLocation($course, 'information');
            $progress = $this->getProgressFromDatabase($course);
        }
        return $progress->location;
    }

    private function getProgressFromDatabase(Course $course) {
        if(student()) {
            $progress =
                CourseProgress::where('course_id', $course->id)
                    ->where('student_id', student()->id)
                    ->first();
        } else {
            $progress =
                CourseProgress::where('course_id', $course->id)
                    ->where('user_id', Auth::id())
                    ->first();
        }
        return $progress;
    }
}
