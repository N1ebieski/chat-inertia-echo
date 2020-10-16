<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Message $message
     * @return boolean
     */
    public function edit(User $user, Message $message) : bool
    {
        return $user->id === $message->user_id;
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Message $message
     * @return boolean
     */
    public function delete(User $user, Message $message) : bool
    {
        return $user->id === $message->user_id;
    }
}
