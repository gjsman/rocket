<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Checkoff extends Component
{
    public Model $model;
    public bool $checked;
    public bool $button = false;

    /**
     * When this component is mounted, it goes and finds a matching Checkoff model for
     * the user if one exists, otherwise falling back to the item being not checked. It
     * then stores the information required to create a Checkoff later and unsets the
     * Model.
     */
    public function mount(): void
    {
        $this->checked = $this->model->checked();
    }

    /**
     * When the property $checked is updated (by button or by click), this function
     * goes and finds a Checkoff model if there is one, and then updates the value.
     * If a Checkoff model does not exist yet for the user, a new one is created.
     */
    public function updated(): void
    {
        $this->model->checkoff($this->checked);
    }

    public function render()
    {
        return view('livewire.checkoff');
    }
}
