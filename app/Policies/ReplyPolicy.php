<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
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
    //判断当前登录用户是否与回复用户或话题用户是同一个
    public function handle(User $user, Reply $reply){
        return $user->checkAuth($reply) || $user->checkAuth($reply->topic);
    }
}
