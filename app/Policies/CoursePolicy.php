<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function view(User $user, Course $course): Response|bool
    {
        if(!student()) {
            if($user->rank >= 5) return true;
            if($user->id === $course->instructor_id) return true;
        } else {
            if(!$course->visible) return false;
            if(student()->enrolled($course)) return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        if($user->rank >= 5) {
            if(!student()) return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function update(User $user, Course $course): Response|bool
    {
        if((($user->rank >= 3) && ($user->id == $course->instructor_id)) || $user->rank >= 5) {
            if(!student()) return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function delete(User $user, Course $course): Response|bool
    {
        if($user->rank >= 5) {
            if(!student()) return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function restore(User $user, Course $course): Response|bool
    {
        if($user->rank >= 5) {
            if(!student()) return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function forceDelete(User $user, Course $course): Response|bool
    {
        if($user->rank >= 5) {
            if(!student()) return true;
        }
        return false;
    }
}
