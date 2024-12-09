<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(ClassroomsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(ReligionsTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
    }
}
