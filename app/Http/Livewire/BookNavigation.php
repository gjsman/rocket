<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\BookPage;
use App\Models\Course;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Whoops\Exception\ErrorException;

class BookNavigation extends Component
{
    public Book $book;
    public string $location = 'information';
    public Collection $pages;
    protected $listeners = ['visibilityChanged' => 'render', 'pageCreated' => 'render'];

    public function render()
    {
        if(Auth::user()->can('update', $this->book)) {
            $this->pages = $this->book->pages->sortBy('order');
        } else {
            $this->pages = $this->book->pages->where('visible', true)->sortBy('order');
        }
        return view('livewire.book-navigation');
    }

    public function updatePageOrder(): void {
        try {
            $order = request()->updates[0]['payload']['params'][0];
            if(Auth::user()->can('update', $this->book)) {
                foreach ($order as $item) {
                    $page = BookPage::where('id', $item['value'])->first();
                    $page->order = (int) $item['order'];
                    $page->save();
                }
            }
            $this->emitTo('book-navigation', 'refresh');
        } catch(ErrorException $e) {
            Log::debug($e);
        }
        $this->book = Book::where('id', $this->book->id)->first();
    }
}
