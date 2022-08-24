<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Collection;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user){
        return $user->role==0;

    }

    public function edit(User $user, User $cnt_user){
        return $user->role==0 || $user->id==$cnt_user->id;

    }

    public function index(User $user){
        return $user->role==0;
    }


}
