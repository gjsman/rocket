<?php

namespace App\Http\Livewire;

use App\Models\Section;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Whoops\Exception\ErrorException;

class Elements extends Component
{
    public Section $section;
    public ?Collection $elements = null;

    protected $listeners = ['visibilityChanged' => 'render'];

    public function render()
    {
        if(Auth::user()->can('update', $this->section)) {
            $videos = $this->section->videos;
            $links = $this->section->links;
            $textBlocks = $this->section->textBlocks;
            $files = $this->section->files;
        } else {
            $videos = $this->section->videos->where('visible', true);
            $links = $this->section->links->where('visible', true);
            $textBlocks = $this->section->textBlocks->where('visible', true);
            $files = $this->section->files->where('visible', true);
        }

        $elements = new Collection;
        $elements = $elements->merge($videos);
        $elements = $elements->merge($links);
        $elements = $elements->merge($textBlocks);
        $elements = $elements->merge($files);

        $this->elements = $elements->sortBy('order');

        return view('livewire.elements');
    }

    public function updateElementOrder(): void {
        try {
            $order = request()->updates[0]['payload']['params'][0];
            if(Auth::user()->can('update', $this->section)) {
                foreach ($order as $item) {
                    $pieces = explode("#", $item['value']);
                    $class = $pieces[0];
                    $id = $pieces[1];

                    $model = $class::where('id', $id)->where('section_id', $this->section->id)->first();
                    $model->order = $item['order'];
                    $model->save();
                }
            }
            $this->emitTo('course-navigation', 'refresh');
        } catch(ErrorException $e) {
            Log::debug($e);
        }
        $this->section = Section::where('id', $this->section->id)->first();
    }
}
