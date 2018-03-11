<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
