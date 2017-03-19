<?php

use Illuminate\Database\Seeder;
use App\Family;
use Faker\Factory as Faker;
use Carbon\Carbon;


class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

         foreach(range(1, 5) as $index)
         {
             $name = $faker->lastName;

             Family::create([
                 'name' => $name,
                 'slug' => str_slug($name),
                 'address' => $faker->buildingNumber . ' ' . $faker->streetName . ' ' . $faker->streetSuffix,
                 'city' => $faker->city,
                 'state' => $faker->stateAbbr,
                 'zip' => $faker->postcode,
                 'phone' => $faker->phoneNumber,
                 'anniversary' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-100 years', 'now')->getTimestamp()),
                 //'photo' => $faker->imageUrl($width = 640, $height = 480),
                //  'photo' => 'sample-photo.jpg',
                //  'thumbnail' => 'sample-thumb.jpg',
                 'status_id' => 1,
             ]);
         }
    }
}
