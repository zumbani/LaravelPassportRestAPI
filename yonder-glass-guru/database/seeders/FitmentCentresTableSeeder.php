<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as DB;
use Faker\Factory as Faker;

class FitmentCentresTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('fitment_centres')->insert([
            'fitment_centre' =>  $faker->city()
        ]);
    }
}
