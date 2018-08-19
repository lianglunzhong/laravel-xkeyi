<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Reply $reply)
    {
        return $reply->user_id === $user->id;
    }
}
