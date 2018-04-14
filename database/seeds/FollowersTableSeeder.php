<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $admin = $users->first();
        $adminId = $admin->id;

        $followers = $users->slice(1);
        $admin->follow($followers->pluck('id')->toArray());

        foreach ($followers as $follower) {
            $follower->follow($adminId);
        }
    }
}
