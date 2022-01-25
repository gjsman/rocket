<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AssignmentSubmissionPolicy
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
     * @param AssignmentSubmission $assignmentSubmission
     * @return Response|bool
     */
    public function view(User $user, AssignmentSubmission $assignmentSubmission): Response|bool
    {
        if(!student()) {
            if($user->rank >= 5) return true;
            if($user->id === $assignmentSubmission->assignment->section->course->instructor_id) return true;
        } else {
            if(!$assignmentSubmission->assignment->visible) return false;
            if(!student()->can('view', $assignmentSubmission->assignment->section)) return false;
            if(student()->enrolled($assignmentSubmission->assignment->section->course)) return true;
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
        return true;
        // return Auth::user()->can('update', $section->course);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param AssignmentSubmission $assignmentSubmission
     * @return Response|bool
     */
    public function update(User $user, AssignmentSubmission $assignmentSubmission): Response|bool
    {
        return $user->can('update', $assignmentSubmission->assignment);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param AssignmentSubmission $assignmentSubmission
     * @return Response|bool
     */
    public function delete(User $user, AssignmentSubmission $assignmentSubmission): Response|bool
    {
        return $user->can('update', $assignmentSubmission->assignment);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param AssignmentSubmission $assignmentSubmission
     * @return Response|bool
     */
    public function restore(User $user, AssignmentSubmission $assignmentSubmission): Response|bool
    {
        return $user->can('update', $assignmentSubmission->assignment);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param AssignmentSubmission $assignmentSubmission
     * @return Response|bool
     */
    public function forceDelete(User $user, AssignmentSubmission $assignmentSubmission): Response|bool
    {
        return $user->can('update', $assignmentSubmission->assignment);
    }
}
