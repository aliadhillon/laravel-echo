<?php

namespace App\Broadcasting;

use App\Post;
use App\User;

class NewCommentChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user, Post $post)
    {
        /**
         * If you want all authenticated users to be able to subscribe to
         * this channel then just return true becase only authenticated user
         * can acess private channels no further authorization is required
         */

        return true;

        /**
         * But if you want only the user who posted this post to see be able
         * to subscribe to this channel then you can do the follwing.
         */
        // return (int) $user->id === (int) $post->user_id;
    }
}
