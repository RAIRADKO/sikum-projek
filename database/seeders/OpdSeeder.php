<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dinasData = [
            ['nama_opd' => 'Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Purworejo'],
            ['nama_opd' => 'Sekreatariat Daerah Kabupaten Purworejo'],
            ['nama_opd' => 'Sekretariat DPRD Kabupaten Purworejo'],
            ['nama_opd' => 'Inspektorat Daerah Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Pendidikan dan Kebudayaan Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Kesehatan Daerah Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Perumahan Rakyat, Kawasan Permukiman dan Pertanahan Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Sosial Pengendalian Penduduk dan Keluarga Berencana Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Ketahanan Pangan dan Pertanian Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Lingkungan Hidup dan Perikanan Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Kependudukan dan Pencatatan Sipil Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak serta Pemberdayaan Masyarakat Desa Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Perhubungan Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Kepemudaan, Olahraga dan Pariwisata Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Perpustakaan dan Kearsipan Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Koperasi, Usaha Kecil, Menengah dan Perdagangan Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Purworejo'],
            ['nama_opd' => 'Dinas Perindustrian, Transmigrasi dan Tenaga Kerja Kabupaten Purworejo'],
            ['nama_opd' => 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Purworejo'],
            ['nama_opd' => 'Badaan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan Kabupaten Purworejo'],
            ['nama_opd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Purworejo'],
            ['nama_opd' => 'Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah Kabupaten Purworejo'],
            ['nama_opd' => 'Badan Penanggulangan Bencana Daerah Kabupaten Purworejo'],
            ['nama_opd' => 'Badan Kesatuan Bangsa dan Politik Kabupaten Purworejo'],
            ['nama_opd' => 'RSUD dr. Tjitrowardojo'],
            ['nama_opd' => 'RSUD RAA Tjokronegoro'],
            ['nama_opd' => 'Kecamatan Grabag'],
            ['nama_opd' => 'Kecamatan Ngombol'],
            ['nama_opd' => 'Kecamatan Purwodadi'],
            ['nama_opd' => 'Kecamatan Bagelen'],
            ['nama_opd' => 'Kecamatan Kaligesing'],
            ['nama_opd' => 'Kecamatan Purworejo'],
            ['nama_opd' => 'Kecamatan Banyuurip'],
            ['nama_opd' => 'Kecamatan Bayan'],
            ['nama_opd' => 'Kecamatan Kutoarjo'],
            ['nama_opd' => 'Kecamatan Butuh'],
            ['nama_opd' => 'Kecamatan Pituruh'],
            ['nama_opd' => 'Kecamatan Kemiri'],
            ['nama_opd' => 'Kecamatan Bruno'],
            ['nama_opd' => 'Kecamatan Gebang'],
            ['nama_opd' => 'Kecamatan Loano'],
            ['nama_opd' => 'Kecamatan Bener'],
        ];

        DB::table('opds')->insert($dinasData);
    }
}
