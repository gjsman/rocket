<?php

namespace App\Http\Livewire;

use App\Models\Grade;
use Livewire\Component;

class Grader extends Component
{
    public $element;
    public ?Grade $grade = null;
    public string $score = "0";

    public function mount()
    {
        if($this->element->grade !== null) {
            $this->score = $this->element->grade->value;
        }
    }

    public function render()
    {
        if(!is_numeric($this->score)) $this->score = "0";
        if((int) $this->score < 0) $this->score = "0";
        if((int) $this->score > 125) $this->score = "100";
        return view('livewire.grader');
    }

    public function save()
    {
        if($this->element->grade !== null) {
            $this->element->grade->value = (int) $this->score;
            $this->element->grade->save();
        } else {
            $grade = new Grade;
            $grade->gradeable_type = "App\Models\\".class_basename($this->element);
            $grade->gradeable_id = $this->element->id;
            $grade->value = (int) $this->score;
            $grade->save();
        }
        $this->element = get_class($this->element)::where('id', $this->element->id)->first();
    }

    public function unset()
    {
        $this->element->grade->delete();
        $this->score = 0;
        $this->element = get_class($this->element)::where('id', $this->element->id)->first();
    }
}
