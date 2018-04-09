<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $loginUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $loginUser, User $user)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $loginUser
     * @return mixed
     */
    public function create(User $loginUser)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $loginUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $loginUser, User $user)
    {
        return $loginUser->id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $loginUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $loginUser, User $user)
    {
        return $loginUser->id === $user->id;
    }

    public function destroy(User $loginUser, User $user)
    {
        return $loginUser->is_admin && $loginUser->id !== $user->id;
    }
}
