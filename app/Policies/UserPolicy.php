<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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

    /**
     * 更新用户数据时，启动授权策略
     *
     * @param User $loginUser 当前登录用户
     * @param User $user      请求更新的用户
     * @return void
     */
    public function update(User $loginUser, User $user)
    {
        return $loginUser->id == $user->id;
    }

    public function destroy(User $admin, User $user)
    {
        return $admin->is_admin && $admin->id !== $user->id;
    }
}
