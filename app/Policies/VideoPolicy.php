<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VideoPolicy
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
     * @param Video $video
     * @return Response|bool
     */
    public function view(User $user, Video $video): Response|bool
    {
        if(!student()) {
            if($user->rank >= 5) return true;
            if($user->id === $video->section->course->instructor_id) return true;
        } else {
            if(!$video->visible) return false;
            if(!student()->can('view', $video->section)) return false;
            if(student()->enrolled($video->section->course)) return true;
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
     * @param Video $video
     * @return Response|bool
     */
    public function update(User $user, Video $video): Response|bool
    {
        return $user->can('update', $video->section);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Video $video
     * @return Response|bool
     */
    public function delete(User $user, Video $video): Response|bool
    {
        return $user->can('update', $video->section);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Video $video
     * @return Response|bool
     */
    public function restore(User $user, Video $video): Response|bool
    {
        return $user->can('update', $video->section);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Video $video
     * @return Response|bool
     */
    public function forceDelete(User $user, Video $video): Response|bool
    {
        return $user->can('update', $video->section);
    }
}
