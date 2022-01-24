<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class StudentManager extends Component
{
    public $createStudentForm = [
        'name' => ''
    ];
    public $confirmingStudentArchival = false;
    public $studentIdBeingArchived;
    public $studentIsActive;

    /**
     * @throws ValidationException
     */
    public function createStudent()
    {
        $this->resetErrorBag();

        $validator = Validator::make([
            'name' => $this->createStudentForm['name'],
        ], [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validator->validateWithBag('createStudent');

        if($this->user->students()->count() < $this->user->students_limit) {
            $student = new Student;
            $student->name = $this->createStudentForm['name'];
            $student->user_id = Auth::id();
            $student->save();
            $this->createStudentForm['name'] = '';
            $this->emit('created');
        } else {
            throw ValidationException::withMessages(['name' => __('There is a limit of ').$this->user->students_limit.__(' students on your account. Contact Homeschool Connections Customer Support to add more students.')]);
        }
    }

    public function archiveStudent()
    {
        $student = $this->user->students()->where('id', $this->studentIdBeingArchived)->first();
        $student->active = !$student->active;
        $student->save();

        $this->user->load('students');

        $this->confirmingStudentArchival = false;
    }

    public function confirmStudentArchival($studentId)
    {
        $this->confirmingStudentArchival = true;
        $this->studentIdBeingArchived = $studentId;
        if($this->user->students()->where('id', $studentId)->first()->active) {
            $this->studentIsActive = true;
        } else {
            $this->studentIsActive = false;
        }
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('student.student-manager');
    }
}
