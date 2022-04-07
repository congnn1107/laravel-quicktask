<?php

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create first admin
        $user = User::create([
            'first_name' => 'Công',
            'last_name' => 'Nguyễn Ngọc',
            'email' => 'admin@gmail.com',
            'username' => 'nguyen-ngoc-cong',
            'password' => '12345678',
        ]);
        $user->is_admin = 1;
        $user->save();

        //create 10 users by factory and attach 10 notes for each user
        factory(User::class, 10)->create()->each(function ($user) {
            $user->notes()->saveMany(factory(Note::class, 10)->make());
        });
    }
}
