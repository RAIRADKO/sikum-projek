<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenSeeder extends Seeder
{
    public function run()
    {
        DB::table('asisten')->insert([
            [
                'kodeass' => 'ASS1',
                'namaass' => 'Asisten Pemerintahan & Kesejahteraan Rakyat'
            ],
            [
                'kodeass' => 'ASS2',
                'namaass' => 'Asisten Perekonomian & Pembangunan'
            ],
            [
                'kodeass' => 'ASS3',
                'namaass' => 'Asisten Administrasi & Umum'
            ]
        ]);
    }
}