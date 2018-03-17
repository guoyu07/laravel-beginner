<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/**
 * @see https://laravel-china.org/docs/laravel/5.5/database-testing#a72713
 */
$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    $createTime = $faker->date . ' ' . $faker->time;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'), // secret
        'remember_token' => str_random(10),
        'created_at' => $createTime,
        'updated_at' => $createTime,
    ];
});
