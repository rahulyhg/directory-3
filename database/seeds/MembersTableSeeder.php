<?php

use Illuminate\Database\Seeder;
use App\Member;
use Faker\Factory as Faker;
use Carbon\Carbon;


class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

         $i = 0;

         $gender = array('male', 'female');

         foreach(range(1, 10) as $index)
         {
             Member::create([
                 'user_id' => $i + 1,
                 'family_id' => $faker->numberBetween(1,5),
                 'family_role_id' => $faker->numberBetween(1,3),
                 'first_name' => $faker->firstName(),
                 'last_name' => $faker->lastName(),
                 'email' => $faker->email(),
                 'birthday' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-100 years', 'now')->getTimestamp()),
                 'mobile' => $faker->phoneNumber,
                 'status_id' => 1,
                 'gender' => $gender[$faker->numberBetween(0,1)],
             ]);

             $i++;
         }
    }
}
