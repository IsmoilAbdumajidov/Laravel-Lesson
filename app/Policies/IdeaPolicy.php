<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{

    public function update(User $user, Idea $idea): bool
    {
        return $user->is($idea->user);
        // return $user->id === $idea->user_id;
    }
    public function create(User $user): bool
    {
        return $user->isAdmin();
        // return $user->id === $idea->user_id;
    }
}
