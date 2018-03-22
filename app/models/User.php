<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * $table 属性指明数据库交互时使用的数据表名
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * 对于用户提交的数据仅有 fillable 定义的字段可以被修改和更新
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * $hidden 是属性用于定义使用 User 实例时，对数据或 JSON 数据中的 passwrod，remember_token 
     * 字段进行隐藏处理
     * 
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
        
        // @see https://laravel-china.org/docs/laravel/5.5/eloquent#events
        static::creating(function($user){
            $user->activation_token = str_random(30);
        });
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
    
    /**
     * 支持 Gravatar 头像功能
     * 
     * @see https://en.gravatar.com 
     * @param integer $size
     * @return void
     */
    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return sprintf('http://www.gravatar.com/avatar/%s?s=%s', $hash, $size);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function feed()
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    /**
     * followers 获取粉丝
     * 
     * @description 用户被 XXX 关注
     * @link https://laravel-china.org/docs/laravel/5.5/eloquent-relationships
     * @see https://laravel.com/api/5.5/Illuminate/Database/Eloquent/Relations/BelongsToMany.html
     * @return mixed
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * following 获取关注用户
     * 
     * @description 用户关注 XXX 
     * @link https://laravel-china.org/docs/laravel/5.5/eloquent-relationships
     * @see https://laravel.com/api/5.5/Illuminate/Database/Eloquent/Relations/BelongsToMany.html
     * @return mixed
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * isFollowing 是否关注给定用户
     *
     * @param int $userId
     * @return boolean
     */
    public function isFollowing($userId)
    {
        return $this->followings->contains($userId);
    }
    
    /**
     * follow 关注用户
     *
     * @param array|string $userIds
     * @return void
     */
    public function follow($userIds)
    {        
        if (!is_array($userIds)) {
            $userIds = compact('userIds');
        }
        
        $this->followings()->sync($userIds, false);
    }

    /**
     * unfollow 取消关注
     *
     * @param array|string $userIds
     * @return void
     */
    public function unfollow($userIds)
    {
        if (!is_array($userIds)) {
            $userIds = compact('userIds');
        }

        $this->followings()->detach($userIds);
    }
}
