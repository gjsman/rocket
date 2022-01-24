<?php

namespace App\Http\Livewire;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Filament\Forms;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditAssignmentSubmission extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?AssignmentSubmission $element = null;
    public Assignment $assignment;

    public function mount(): void
    {
        if($this->element) {
            $this->form->fill([
                'file' => $this->element->file,
            ]);
        } else {
            $this->form->fill();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('file')->acceptedFileTypes([
                'application/pdf',
                'application/msword',
                'image/jpeg',
                'image/png',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation'
            ])->required()->helperText('Accepted Files: doc, docx, xls, xlsx, ppt, pptx, pdf, jpg, jpeg, png')
        ];
    }

    public function submit()
    {
        if($this->element) {
            $this->element->update(
                $this->form->getState(),
            );
            return redirect()->route('assignment.previous', ['element' => $this->element->assignment]);
        } else {
            $values = $this->form->getState();
            if(student()) {
                $values['student_id'] = student()->id;
            } else {
                $values['user_id'] = Auth::id();
            }
            $values['assignment_id'] = $this->assignment->id;
            AssignmentSubmission::create($values);
            return redirect()->route('assignment.previous', ['element' => $this->assignment]);
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.edit-element');
    }
}
