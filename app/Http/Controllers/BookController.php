<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookPage;
use App\Models\BookProgress;
use App\Models\Link;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function create(Section $section): Factory|View|Application
    {
        return view('course.edit-element', ['section' => $section, 'class' => Book::class]);
    }

    public function show(Book $element): Factory|View|Application|RedirectResponse
    {
        $location = $this->getLocation($element);
        $page = null;
        if(is_numeric($location)) {
            $page = BookPage::where('id', $location)->where('book_id', $element->id)->first();
            if(!$page) return redirect()->route('book.location', ['element' => $element, 'location' => 'information']);
            if(Auth::user()->cannot('view', $page)) return redirect()->route('book.location', ['element' => $element, 'location' => 'information']);
        }
        return view('book.show', ['element' => $element, 'page' => $page, 'location' => $location]);
    }

    public function edit(Book $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(Book $element): RedirectResponse
    {
        $course = $element->section->course;
        $element->delete();
        return redirect()->route('course', ['course' => $course]);
    }

    public function location(Book $element, string $location): RedirectResponse
    {
        if(is_numeric($location)) {
            if(BookPage::where('book_id', $element->id)->where('id', $location)->exists()) {
                $this->setLocation($element, $location);
            } else {
                $this->setLocation($element, 'information');
            }
        } elseif ($location === 'information' || $location === 'addPage') {
            if ($location === 'addPage') {
                if(Auth::user()->can('update', $element)) {
                    $this->setLocation($element, $location);
                } else {
                    $this->setLocation($element, 'information');
                }
            } else {
                $this->setLocation($element, $location);
            }
        } else {
            $this->setLocation($element, 'information');
        }
        return redirect()->route('book', $element);
    }

    private function setLocation(Book $book, string $location): void
    {
        $progress = $this->getProgressFromDatabase($book);
        if($progress === NULL) {
            $progress = new BookProgress;
            $progress->book_id = $book->id;
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

    private function getLocation(Book $book): string
    {
        $progress = $this->getProgressFromDatabase($book);
        if($progress === NULL) {
            $this->setLocation($book, 'information');
            $progress = $this->getProgressFromDatabase($book);
        }
        return $progress->location;
    }

    private function getProgressFromDatabase(Book $book) {
        if(student()) {
            $progress =
                BookProgress::where('book_id', $book->id)
                    ->where('student_id', student()->id)
                    ->first();
        } else {
            $progress =
                BookProgress::where('book_id', $book->id)
                    ->where('user_id', Auth::id())
                    ->first();
        }
        return $progress;
    }
}
