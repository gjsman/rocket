<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\BookPage;
use Filament\Forms;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditBookPage extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?BookPage $element = null;
    public Book $book;

    public function mount(): void
    {
        if($this->element) {
            $this->form->fill([
                'name' => $this->element->name,
                'summary' => $this->element->summary,
                'visible' => $this->element->visible,
            ]);
        } else {
            $this->form->fill();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\RichEditor::make('summary'),
            Forms\Components\Checkbox::make('visible')->default(true),
        ];
    }

    public function submit()
    {
        if($this->element) {
            $this->element->update(
                $this->form->getState(),
            );
            return redirect()->route('book.location', ['element'=> $this->element->book, 'location' => $this->element]);
        } else {
            $values = $this->form->getState();
            $values['book_id'] = $this->book->id;
            $values['order'] = 1000;
            $newBookPage = BookPage::create($values);
            return redirect()->route('book.location', ['element'=> $this->book, 'location' => $newBookPage]);
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.edit-element');
    }
}
