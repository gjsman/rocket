<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class SectionPolicy
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
     * @param Section $section
     * @return Response|bool
     */
    public function view(User $user, Section $section): Response|bool
    {
        if(!student()) {
            if($user->rank >= 5) return true;
            if($user->id === $section->course->instructor_id) return true;
        } else {
            if(!$section->visible) return false;
            if(student()->enrolled($section->course)) return true;
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
        // TODO: Imperfect Guard!
        if($user->rank >= 3) {
            if(!student()) return true;
        }
        return false;
        // return Auth::user()->can('update', $section->course);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Section $section
     * @return Response|bool
     */
    public function update(User $user, Section $section): Response|bool
    {
        return $user->can('update', $section->course);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Section $section
     * @return Response|bool
     */
    public function delete(User $user, Section $section): Response|bool
    {
        return $user->can('update', $section->course);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Section $section
     * @return Response|bool
     */
    public function restore(User $user, Section $section): Response|bool
    {
        return $user->can('update', $section->course);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Section $section
     * @return Response|bool
     */
    public function forceDelete(User $user, Section $section): Response|bool
    {
        return $user->can('update', $section->course);
    }
}
