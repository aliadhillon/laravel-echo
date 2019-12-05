<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Post;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('post.{id}', function ($user, $id) {
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
    // return (int) $user->id === (int) Post::find($id)->user_id;
});
