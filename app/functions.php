<?php

use Illuminate\Support\Facades\File;

if (!function_exists('get_current_git_commit')) {
    function get_current_git_commit($branch = 'master'): bool|string
    {
        if(File::exists(sprintf('../.git/refs/heads/%s', $branch))) {
            $hash = File::get(sprintf('../.git/refs/heads/%s', $branch));
            if($hash) return $hash;
        }
        return false;
    }
}
