<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->activation_token = str_random(30);
        });
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function feed()
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->email)));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Undocumented 粉丝
     *
     * @return void
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * Undocumented 关注用户
     *
     * @return void
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * Undocumented 关注
     *
     * @param [type] $userIds
     * @return void
     */
    public function follow($userIds)
    {
        $userIds = !is_array($userIds) ? compact('userIds') : $userIds;
        $this->followings()->syncWithoutDetaching($userIds);
    }

    /**
     * Undocumented 取关
     *
     * @param [type] $userIds
     * @return void
     */
    public function unfollow($userIds)
    {
        $userIds = !is_array($userIds) ? compact('userIds') : $userIds;
        $this->followings()->detach($userIds);
    }

    /**
     * Undocumented 是否关注
     *
     * @param [type] $userId
     * @return boolean
     */
    public function isFollowing($userId)
    {
        return $this->followings->contains($userId);
    }
}
