<?php

namespace App\Policies;

use App\Feed;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPolicy
{
    use HandlesAuthorization;

    public function manage(User $user ,Feed $feed)
    {
        return $feed->user_id == $user->id;
    }
}
