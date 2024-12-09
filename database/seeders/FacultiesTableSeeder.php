<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Faculty;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->delete();
        $faculties=[
            ['en' => 'Faculty of Engineering', 'ar' => 'كلية الهندسة'],
            ['en' => 'Faculty of Medicine', 'ar' => 'كلية الطب'],
            ['en' => 'Faculty of Science', 'ar' => 'كلية العلوم'],
            ['en' => 'Faculty of Arts', 'ar' => 'كلية الفنون'],
            ['en' => 'Faculty of Business Administration', 'ar' => 'كلية إدارة الأعمال'],
            ['en' => 'Faculty of Education', 'ar' => 'كلية التربية'],
            ['en' => 'Faculty of Law', 'ar' => 'كلية الحقوق'],
            ['en' => 'Faculty of Computer Science', 'ar' => 'كلية علوم الحاسب'],
            ['en' => 'Faculty of Pharmacy', 'ar' => 'كلية الصيدلة'],
        ];
        foreach($faculties as $facultie){
            Faculty::create(['name'=>$facultie]);
        }
    }
}
