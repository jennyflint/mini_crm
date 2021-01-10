<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user owner models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function owner(User $user, Client $client): bool
    {
        return $user->id === $client->user_id;
    }
}
