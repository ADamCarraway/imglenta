<?php

namespace App\Policies;

use App\Feed;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPolicy
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

    public function destroy(User $user ,Feed $feed)
    {
        return $feed->user_id == $user->id;
    }
}
