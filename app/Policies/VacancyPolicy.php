<?php

namespace App\Policies;

use App\Models\UserEmployer;
use App\Models\Vacancy;

class VacancyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserEmployer $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserEmployer $user, Vacancy $vacancy): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserEmployer $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserEmployer $user, Vacancy $vacancy): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserEmployer $user, Vacancy $vacancy): bool
    {
        if($user->id == $vacancy->company->user_employer->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserEmployer $user, Vacancy $vacancy): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserEmployer $user, Vacancy $vacancy): bool
    {
        return true;
    }
}
