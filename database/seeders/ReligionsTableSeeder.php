<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Religion;

class ReligionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->delete();
        $religions =
            [
                ['en' => 'Islam', 'ar' => 'الإسلام'],
                ['en' => 'Christianity', 'ar' => 'المسيحية'],
                ['en' => 'Other', 'ar' => 'أخرى'],
            ];
        foreach ($religions as $religion) {
            Religion::create(['name' => $religions]);
        }
    }
}
