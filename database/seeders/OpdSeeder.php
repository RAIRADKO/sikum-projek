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
        $opds = [
            ['kodeopd' => 'Bagian Adbang Setda', 'namaopd' => 'Bagian Administrasi Pembangunan Setda', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'Bagian Hukum Setda', 'namaopd' => 'Bagian Hukum Setda', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Bagian Kesra Setda', 'namaopd' => 'Bagian Kesejahteraan Rakyat Setda', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Bagian Organisasi Setda', 'namaopd' => 'Bagian Organisasi Setda', 'kodeass' => 'ASS3'],
            ['kodeopd' => 'Bagian Pemerintahan Setda ', 'namaopd' => 'Bagian Pemerintahan Setda ', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Bagian Pengadaan Barjas Setda', 'namaopd' => 'Bagian Pengadaan Barang & Jasa Setda', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'Bagian Perekonomian & SDA Setda', 'namaopd' => 'Bagian Perekonomian & Sumber Daya Alam Setda', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'Bagian Prokopim Setda', 'namaopd' => 'Bagian Protokol & Komunikasi Pimpinan Setda', 'kodeass' => 'ASS3'],
            ['kodeopd' => 'Bagian Umum Setda', 'namaopd' => 'Bagian Umum Setda', 'kodeass' => 'ASS3'],
            ['kodeopd' => 'BAKESBANGPOL', 'namaopd' => 'Badan Kesatuan Bangsa dan Politik', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'BAPPERIDA', 'namaopd' => 'Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'BKPSDM', 'namaopd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia ', 'kodeass' => 'ASS3'],
            ['kodeopd' => 'BPBD', 'namaopd' => 'Badan Penanggulangan Bencana Daerah', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'BPKPAD', 'namaopd' => 'Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah ', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'BUMD', 'namaopd' => 'Badan Usaha Milik Daerah', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DINDIKBUD', 'namaopd' => 'Dinas Pendidikan dan Kebudayaan', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINDUKCAPIL', 'namaopd' => 'Dinas Kependudukan dan Pencatatan Sipil', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINHUB', 'namaopd' => 'Dinas Perhubungan', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DINKESDA', 'namaopd' => 'Dinas Kesehatan Daerah', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINKOMINFOSTASANDI (Urusan Kominfo & Persandian)', 'namaopd' => 'Dinas Komunikasi, Informatika, Statistik dan Persandian (Urusan Kominfo & Persandian)', 'kodeass' => 'ASS3'],
            ['kodeopd' => 'DINKOMINFOSTASANDI (Urusan Statistik)', 'namaopd' => 'Dinas Komunikasi, Informatika, Statistik dan Persandian (Urusan Statistik)', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DINPERINTRANSNAKER (Urusan Perindustrian & ESDM)', 'namaopd' => 'Dinas Perindustrian, Transmigrasi dan Tenaga Kerja (Urusan Perindustrian & ESDM)', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DINPERINTRANSNAKER (Urusan Tenaga Kerja & Transmigrasi)', 'namaopd' => 'Dinas Perindustrian, Transmigrasi dan Tenaga Kerja (Urusan Tenaga Kerja & Transmigrasi)', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINPERKIMTAN (Urusan Pertanahan)', 'namaopd' => 'Dinas Perumahan Rakyat, Kawasan Permukiman dan Pertanahan (Urusan Pertanahan)', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINPERKIMTAN (Urusan Perumahan & Kawasan Permukiman)', 'namaopd' => 'Dinas Perumahan Rakyat, Kawasan Permukiman dan Pertanahan (Urusan Perumahan & Kawasan Permukiman)', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DINPORAPAR', 'namaopd' => 'Dinas Kepemudaan, Olahraga dan Pariwisata', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINPPPAPMD', 'namaopd' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak serta Pemberdayaan Masyarakat dan Desa', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DINPUSIP', 'namaopd' => 'Dinas Perpustakaan dan Kearsipan ', 'kodeass' => 'ASS3'],
            ['kodeopd' => 'DINSOSDALDUKKB', 'namaopd' => 'Dinas Sosial, Pengendalian Penduduk dan Keluarga Berencana', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DKPP', 'namaopd' => 'Dinas Ketahanan Pangan dan Pertanian', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DKUKMP', 'namaopd' => 'Dinas Koperasi, Usaha Kecil, Menengah dan Perdagangan', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DLHP', 'namaopd' => 'Dinas Lingkungan Hidup dan Perikanan', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DPMPTSP (Bidang PTSP)', 'namaopd' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (Bidang PTSP)', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'DPMPTSP (Urusan Penanaman Modal)', 'namaopd' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (Bidang PTSP)', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'DPUPR', 'namaopd' => 'Dinas Pekerjaan Umum dan Penataan Ruang ', 'kodeass' => 'ASS2'],
            ['kodeopd' => 'INSPEKTORAT DAERAH', 'namaopd' => 'Inspektorat Daerah', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Bagelen', 'namaopd' => 'Kecamatan Bagelen', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Banyuurip', 'namaopd' => 'Kecamatan Banyuurip', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Bayan', 'namaopd' => 'Kecamatan Bayan', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan BENER', 'namaopd' => 'Kecamatan Bener', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Bruno', 'namaopd' => 'Kecamatan Bruno', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Butuh', 'namaopd' => 'Kecamatan Butuh', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Gebang', 'namaopd' => 'Kecamatan Gebang', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Grabag', 'namaopd' => 'Kecamatan Grabag', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Kaligesing', 'namaopd' => 'Kecamatan Kaligesing', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Kemiri', 'namaopd' => 'Kecamatan Kemiri', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Kutoarjo', 'namaopd' => 'Kecamatan Kutoarjo', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Loano', 'namaopd' => 'Kecamatan Loano', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Ngombol', 'namaopd' => 'Kecamatan Ngombol', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Pituruh', 'namaopd' => 'Kecamatan Pituruh', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Purwodadi', 'namaopd' => 'Kecamatan Purwodadi', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Kecamatan Purworejo', 'namaopd' => 'Kecamatan Purworejo', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'KPU', 'namaopd' => 'Komisi Pemilihan Umum', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'Pengadilan Negeri', 'namaopd' => 'Pengadilan Negeri', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'RSUD R.A.A Tjokronegoro', 'namaopd' => 'RSUD R.A.A Tjokronegoro', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'RSUD Tjitrowardojo', 'namaopd' => 'RSUD Tjitrowardojo', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'SATPOL PP DAMKAR', 'namaopd' => 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran', 'kodeass' => 'ASS1'],
            ['kodeopd' => 'SETWAN', 'namaopd' => 'Sekretariat DPRD', 'kodeass' => 'ASS1'],
        ];

        DB::table('opds')->insert($opds);
    }
}