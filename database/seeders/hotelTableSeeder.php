<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class hotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = ['CVK Park Bosphorus Hotel', 'Akra Hotel', 'Uzungol Soylu Hotel','DoubleTree by Hilton Bodrum','Rixos Premium Bodrum'];
foreach ($hotels as $hotel)
    {
        DB::table('hotels')->insert([
            'name' => $hotel,
            'rating'=>'5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}
