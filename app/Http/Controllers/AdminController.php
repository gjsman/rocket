<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }

    public function courses(): Factory|View|Application
    {
        return view('admin.courses');
    }

    public function instructors(): Factory|View|Application
    {
        return view('admin.instructors');
    }
}
