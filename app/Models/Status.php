<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * @see https://laravel-china.org/docs/laravel/5.5/eloquent#32ac15
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
