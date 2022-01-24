<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('instructors.index');
    }

    public function show(User $instructor): Factory|View|Application
    {
        if($instructor->rank < 3) abort(404);
        return view('instructors.show', ['instructor' => $instructor]);
    }
}
