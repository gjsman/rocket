<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookPage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookPageController extends Controller
{
    public function edit(BookPage $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(BookPage $element): RedirectResponse
    {
        $book = $element->book;
        $element->delete();
        return redirect()->route('book', ['element' => $book]);
    }
}
