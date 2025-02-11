<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $genders = [
            ['en' => 'Male', 'ar' => 'ذكر'],
            ['en' => 'Female', 'ar' => 'أنثى'],
        ];
        foreach ($genders as $gender) {
            Gender::create(['name' => $gender]);
        }
    }
}
