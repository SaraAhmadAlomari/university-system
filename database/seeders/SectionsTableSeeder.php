<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
        $sections = [
            ['en' => 'Department of Civil Engineering', 'ar' => 'قسم الهندسة المدنية'],
            ['en' => 'Department of Mechanical Engineering', 'ar' => 'قسم الهندسة الميكانيكية'],
            ['en' => 'Department of Electrical Engineering', 'ar' => 'قسم الهندسة الكهربائية'],
            ['en' => 'Department of Computer Engineering', 'ar' => 'قسم هندسة الحاسب'],

        ];
        foreach ($sections as $section) {
            Section::create(['name' => $section, 'status'=>1,'faculty_id' => 28, 'classroom_id'=>7]);
        }
    }
}
