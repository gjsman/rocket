<?php

use App\Models\Student;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

if (!function_exists('student')) {
    function student(): ?Student
    {
        if(!Auth::check()) abort(403);
        if(session('student') === NULL) return null;
        $student = Cache::driver('array')->rememberForever('student_'.session('student'), function() {
            return Student::where('id', session('student'))->where('user_id', Auth::id())->first();
        });
        if(is_null($student)) return null;
        $student->updated_at = now();
        $student->save();
        return $student;
    }
}

if (!function_exists('student_set')) {
    function student_set(Student $student): bool|null
    {
        if((int) $student->user_id === Auth::id()) {
            return session(['student' => $student->id]);
        }
        return false;
    }
}

if (!function_exists('student_unset')) {
    function student_unset(): bool|null
    {
        return session(['student' => null]);
    }
}

if (!function_exists('get_current_git_commit')) {
    function get_current_git_commit($branch = 'master'): ?string
    {
        if(File::exists(sprintf('../.git/refs/heads/%s', $branch))) {
            $hash = File::get(sprintf('../.git/refs/heads/%s', $branch));
            if($hash) return $hash;
        }
        return null;
    }
}
