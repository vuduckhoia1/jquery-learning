<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function update(User $user, Post $post){
//        dd($user->id, $post->user->id);
        return $user->id===$post->user->id;
    }

    public function destroy(User $user, Post $post){
        return $user->id===$post->user->id || $user->role==0;
    }
}
