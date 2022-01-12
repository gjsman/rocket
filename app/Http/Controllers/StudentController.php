<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function set(Student $student): RedirectResponse
    {
        student_set($student);
        return redirect()->route('dashboard');
    }

    public function unset(): RedirectResponse
    {
        student_unset();
        return redirect()->route('dashboard');
    }
}
