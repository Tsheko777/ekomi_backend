<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('tbl_contacts')->insert([
            'email' => $faker->unique()->email,
            'fullName' => $faker->name,
            'department' => $faker->word,
            'phoneNumber' => $faker->phoneNumber,
            'jobTitle' => $faker->word,
        ]);
    }
}
