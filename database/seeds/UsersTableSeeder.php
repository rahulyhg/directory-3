<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
             'first_name' => "Admin",
             'last_name' => "Admin",
             'email' => "admin@admin.com",
             'password' => Hash::make('password')
         ]);
    }
}
