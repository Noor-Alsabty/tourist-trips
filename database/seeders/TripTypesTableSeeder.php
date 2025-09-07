<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TripTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['ثقافية', 'عائلية', 'ثنائية'];
foreach ($types as $type)
    {
        DB::table('types')->insert([
            'name' => $type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}
