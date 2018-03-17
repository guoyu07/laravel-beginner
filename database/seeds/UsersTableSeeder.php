<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @see https://laravel-china.org/docs/laravel/5.5/seeding#6d1b70
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();

        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'huliuqing';
        $user->email = 'liuqing_hu@126.com';
        $user->password = bcrypt('huliuqing');
        $user->is_admin = true;
        $user->save();
    }
}
