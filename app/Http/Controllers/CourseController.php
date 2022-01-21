<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\Section;
use App\Models\Student;
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
        $section = null;
        if(is_numeric($location)) {
            $section = Section::where('id', $location)->where('course_id', $course->id)->first();
            if(!$section) return redirect()->route('course.location', ['course' => $course, 'location' => 'information']);
        }
        return view('course.index', ['course' => $course, 'location' => $location, 'section' => $section]);
    }

    public function location(Course $course, string $location): RedirectResponse
    {
        if(is_numeric($location)) {
            if(Section::where('course_id', $course->id)->where('id', $location)->exists()) {
                $this->setLocation($course, $location);
            } else {
                $this->setLocation($course, 'information');
            }
        } elseif ($location === 'information' || $location === 'addSection' || $location === 'instructorAccess' || $location === 'participants' || $location === 'completion') {
            if ($location === 'participants' || $location === 'addSection') {
                if(Auth::user()->can('update', $course)) {
                    $this->setLocation($course, $location);
                } else {
                    $this->setLocation($course, 'information');
                }
            } else {
                $this->setLocation($course, $location);
            }
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

    public function enroll(Course $course, Student $student): RedirectResponse
    {
        $course->enroll($student);
        return redirect()->route('course', $course);
    }

    public function unenroll(Course $course, Student $student): RedirectResponse
    {
        $course->unenroll($student);
        return redirect()->route('course', $course);
    }

    public function editSection(Section $section): Factory|View|Application
    {
        return view('course.edit-section', ['section' => $section]);
    }

    public function deleteSection(Section $section): RedirectResponse
    {
        $course = $section->course;
        $section->delete();
        return redirect()->route('course', ['course' => $course]);
    }
}
