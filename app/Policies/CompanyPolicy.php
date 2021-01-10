<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user owner models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function owner(User $user, Company $company): bool 
    {
        return $user->id === $company->user_id;
    }
}
