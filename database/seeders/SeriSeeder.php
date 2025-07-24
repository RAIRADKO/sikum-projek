<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kategori' => 'APBD', 'seri' => 'A'],
            ['kategori' => 'PAJAK', 'seri' => 'B'],
            ['kategori' => 'RETRIBUSI', 'seri' => 'C'],
            ['kategori' => 'SOT', 'seri' => 'D'],
            ['kategori' => 'LAINNYA', 'seri' => 'E'],
        ];

        DB::table('seri')->insert($data);
    }
}