<?php

namespace App\Policies;

use App\Models\QuizTrueFalseQuestion;
use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class QuizTrueFalseQuestionPolicy
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
     * @param QuizTrueFalseQuestion $quizTrueFalseQuestion
     * @return Response|bool
     */
    public function view(User $user, QuizTrueFalseQuestion $quizTrueFalseQuestion): Response|bool
    {
        if(!student()) {
            /** Admin? Yes */
            if($user->rank >= 5) return true;
            /** Teacher? Yes */
            if($user->id === $quizTrueFalseQuestion->quiz->section->course->instructor_id) return true;
        } else {
            /** Visible and Student? No access */
            if(!$quizTrueFalseQuestion->visible) return false;
            /** Not enrolled and Student? No access */
            if(student()->enrolled($quizTrueFalseQuestion->quiz->section->course)) return true;
        }
        /** None of the above, no access */
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
     * @param QuizTrueFalseQuestion $quizTrueFalseQuestion
     * @return Response|bool
     */
    public function update(User $user, QuizTrueFalseQuestion $quizTrueFalseQuestion): Response|bool
    {
        return $user->can('update', $quizTrueFalseQuestion->quiz->section);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param QuizTrueFalseQuestion $quizTrueFalseQuestion
     * @return Response|bool
     */
    public function delete(User $user, QuizTrueFalseQuestion $quizTrueFalseQuestion): Response|bool
    {
        return $user->can('update', $quizTrueFalseQuestion->quiz->section);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param QuizTrueFalseQuestion $quizTrueFalseQuestion
     * @return Response|bool
     */
    public function restore(User $user, QuizTrueFalseQuestion $quizTrueFalseQuestion): Response|bool
    {
        return $user->can('update', $quizTrueFalseQuestion->quiz->section);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param QuizTrueFalseQuestion $quizTrueFalseQuestion
     * @return Response|bool
     */
    public function forceDelete(User $user, QuizTrueFalseQuestion $quizTrueFalseQuestion): Response|bool
    {
        return $user->can('update', $quizTrueFalseQuestion->quiz->section);
    }
}
