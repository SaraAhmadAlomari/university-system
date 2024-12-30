<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nationality;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->delete();
        $nationalities =[
                ['en' => 'Egyptian', 'ar' => 'مصري'],
                ['en' => 'Saudi', 'ar' => 'سعودي'],
                ['en' => 'Kuwaiti', 'ar' => 'كويتي'],
                ['en' => 'Jordanian', 'ar' => 'أردني'],
                ['en' => 'Lebanese', 'ar' => 'لبناني'],
                ['en' => 'Palestinian', 'ar' => 'فلسطيني'],
                ['en' => 'Syrian', 'ar' => 'سوري'],
                ['en' => 'Iraqi', 'ar' => 'عراقي'],
                ['en' => 'Omani', 'ar' => 'عماني'],
                ['en' => 'Qatari', 'ar' => 'قطري'],
                ['en' => 'Bahraini', 'ar' => 'بحريني'],
                ['en' => 'Moroccan', 'ar' => 'مغربي'],
                ['en' => 'Algerian', 'ar' => 'جزائري'],
                ['en' => 'Tunisian', 'ar' => 'تونسي'],
        ];
        foreach ($nationalities as $nationality) {
            Nationality::create(['name' => $nationality]);
        }
    }
}
