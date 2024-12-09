<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en' => 'Room 101', 'ar' => 'صف 101'],
            ['en' => 'Lab 3', 'ar' => 'مختبر 3'],
            ['en' => 'Lecture Hall A', 'ar' => 'قاعة المحاضرات أ'],

        ];
        foreach ($classrooms as $classroom) {
            Classroom::create(['name' => $classroom, 'faculty_id'=>28]);
        }
    }
}
