<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\NomorSk;
use App\Models\NomorPerbup;
use App\Models\ProsesSk;
use App\Models\ProsesPerbup;
use App\Models\ProsesLain;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $userOpdId = $user->opd_id;
        
        // Filter parameters
        $periode = $request->get('periode', 'bulan_ini');
        $jenisLaporan = $request->get('jenis_laporan', 'semua');
        $kategori = $request->get('kategori', 'semua');
        $search = $request->get('search');
        
        // Date range based on periode
        $dateRange = $this->getDateRange($periode);
        
        // Ringkasan Data Penting
        $ringkasan = $this->getRingkasanData($userOpdId, $dateRange);
        
        // Daftar Laporan dengan filter dan pencarian
        $laporanQuery = $this->buildLaporanQuery($userOpdId, $jenisLaporan, $kategori, $search, $dateRange);
        $laporan = $laporanQuery->paginate(10)->appends($request->query());
        
        // Notifikasi
        $notifikasi = $this->getNotifikasi($userOpdId);
        
        // Data untuk filter dropdown
        $filterData = $this->getFilterData();
        
        return view('user.dashboard', compact(
            'user',
            'ringkasan',
            'laporan',
            'notifikasi',
            'filterData',
            'periode',
            'jenisLaporan',
            'kategori',
            'search'
        ));
    }
    
    private function getDateRange($periode)
    {
        $now = Carbon::now();
        
        switch ($periode) {
            case 'hari_ini':
                return [
                    'start' => $now->startOfDay(),
                    'end' => $now->endOfDay()
                ];
            case 'minggu_ini':
                return [
                    'start' => $now->startOfWeek(),
                    'end' => $now->endOfWeek()
                ];
            case 'bulan_ini':
                return [
                    'start' => $now->startOfMonth(),
                    'end' => $now->endOfMonth()
                ];
            case 'tahun_ini':
                return [
                    'start' => $now->startOfYear(),
                    'end' => $now->endOfYear()
                ];
            case 'semua':
            default:
                return [
                    'start' => Carbon::create(2020, 1, 1),
                    'end' => $now->endOfYear()
                ];
        }
    }
    
    private function getRingkasanData($opdId, $dateRange)
    {
        // SK yang sudah selesai dan bisa dicetak
        $skSelesai = NomorSk::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->whereBetween('tglsk', [$dateRange['start'], $dateRange['end']])
            ->count();
            
        // Perbup yang sudah selesai dan bisa dicetak
        $perbupSelesai = NomorPerbup::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->whereBetween('tglpb', [$dateRange['start'], $dateRange['end']])
            ->count();
            
        // SK Lainnya yang sudah selesai
        $skLainSelesai = ProsesLain::where('kodeopd', $opdId)
            ->where('status', 'Selesai')
            ->whereBetween('tglmasuk', [$dateRange['start'], $dateRange['end']])
            ->count();
        
        // Total laporan tersedia
        $totalTersedia = $skSelesai + $perbupSelesai + $skLainSelesai;
        
        // Laporan dalam proses
        $skProses = ProsesSk::where('kodeopd', $opdId)
            ->where('status', 'Proses')
            ->whereBetween('tglmasuksk', [$dateRange['start'], $dateRange['end']])
            ->count();
            
        $perbupProses = ProsesPerbup::where('kodeopd', $opdId)
            ->where('status', 'proses')
            ->whereBetween('tglmasukpb', [$dateRange['start'], $dateRange['end']])
            ->count();
            
        $skLainProses = ProsesLain::where('kodeopd', $opdId)
            ->where('status', 'Diproses')
            ->whereBetween('tglmasuk', [$dateRange['start'], $dateRange['end']])
            ->count();
        
        $totalDalamProses = $skProses + $perbupProses + $skLainProses;
        
        // Laporan terbaru (5 terbaru)
        $laporanTerbaru = $this->getLaporanTerbaru($opdId, 5);
        
        // Laporan yang belum dicetak (status diambil = null atau kosong)
        $belumDicetak = NomorSk::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->whereNull('tglambilsk')
            ->count() +
            NomorPerbup::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->whereNull('tglambilpb')
            ->count();
        
        return [
            'total_tersedia' => $totalTersedia,
            'dalam_proses' => $totalDalamProses,
            'belum_dicetak' => $belumDicetak,
            'laporan_terbaru' => $laporanTerbaru,
            'sk_selesai' => $skSelesai,
            'perbup_selesai' => $perbupSelesai,
            'sk_lain_selesai' => $skLainSelesai
        ];
    }
    
    private function getLaporanTerbaru($opdId, $limit = 5)
    {
        $sk = NomorSk::select(DB::raw("CAST(nosk AS CHAR) as id"), 'judulsk as judul', 'tglsk as tanggal', 'status', DB::raw("'SK' as jenis"))
            ->where('kodeopd', $opdId)
            ->whereNotNull('tglsk');
            
        $perbup = NomorPerbup::select(DB::raw("CAST(nopb AS CHAR) as id"), 'judulpb as judul', 'tglpb as tanggal', 'status', DB::raw("'Perbup' as jenis"))
            ->where('kodeopd', $opdId)
            ->whereNotNull('tglpb');
            
        $skLain = ProsesLain::select('kodelain as id', 'judul', 'tglmasuk as tanggal', 'status', DB::raw("'SK Lainnya' as jenis"))
            ->where('kodeopd', $opdId)
            ->whereNotNull('tglmasuk');
        
        return $sk->union($perbup)->union($skLain)
            ->orderBy('tanggal', 'desc')
            ->limit($limit)
            ->get();
    }
    
    private function buildLaporanQuery($opdId, $jenisLaporan, $kategori, $search, $dateRange)
    {
        $sk = NomorSk::select(
                DB::raw("CAST(nosk AS CHAR) as id"),
                'judulsk as judul',
                'tglsk as tanggal',
                'status',
                'tglambilsk as tgl_ambil',
                'kodeopd',
                DB::raw("'SK' as jenis"),
                DB::raw("CASE WHEN status = 'selesai' THEN 'selesai' ELSE 'proses' END as kategori_status")
            )
            ->where('kodeopd', $opdId)
            ->whereBetween('tglsk', [$dateRange['start'], $dateRange['end']]);
            
        $perbup = NomorPerbup::select(
                DB::raw("CAST(nopb AS CHAR) as id"),
                'judulpb as judul',
                'tglpb as tanggal',
                'status',
                'tglambilpb as tgl_ambil',
                'kodeopd',
                DB::raw("'Perbup' as jenis"),
                DB::raw("CASE WHEN status = 'selesai' THEN 'selesai' ELSE 'proses' END as kategori_status")
            )
            ->where('kodeopd', $opdId)
            ->whereBetween('tglpb', [$dateRange['start'], $dateRange['end']]);
            
        $skProses = ProsesSk::select(
                'kodesk as id',
                'judulsk as judul',
                'tglmasuksk as tanggal',
                'status',
                DB::raw('NULL as tgl_ambil'),
                'kodeopd',
                DB::raw("'SK Proses' as jenis"),
                DB::raw("CASE WHEN status = 'Selesai' THEN 'selesai' ELSE 'proses' END as kategori_status")
            )
            ->where('kodeopd', $opdId)
            ->whereBetween('tglmasuksk', [$dateRange['start'], $dateRange['end']]);
            
        $perbupProses = ProsesPerbup::select(
                'kodepb as id',
                'judulpb as judul',
                'tglmasukpb as tanggal',
                'status',
                DB::raw('NULL as tgl_ambil'),
                'kodeopd',
                DB::raw("'Perbup Proses' as jenis"),
                DB::raw("CASE WHEN status = 'selesai' THEN 'selesai' ELSE 'proses' END as kategori_status")
            )
            ->where('kodeopd', $opdId)
            ->whereBetween('tglmasukpb', [$dateRange['start'], $dateRange['end']]);
            
        $skLain = ProsesLain::select(
                'kodelain as id',
                'judul',
                'tglmasuk as tanggal',
                'status',
                'tglambil as tgl_ambil',
                'kodeopd',
                DB::raw("'SK Lainnya' as jenis"),
                DB::raw("CASE WHEN status = 'Selesai' THEN 'selesai' ELSE 'proses' END as kategori_status")
            )
            ->where('kodeopd', $opdId)
            ->whereBetween('tglmasuk', [$dateRange['start'], $dateRange['end']]);
        
        // Union all queries
        $query = $sk->union($perbup)->union($skProses)->union($perbupProses)->union($skLain);
        
        // Apply filters
        if ($jenisLaporan != 'semua') {
            $query->where('jenis', $jenisLaporan);
        }
        
        if ($kategori != 'semua') {
            $query->where('kategori_status', $kategori);
        }
        
        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }
        
        return $query->orderBy('tanggal', 'desc');
    }
    
    private function getNotifikasi($opdId)
    {
        $notifikasi = [];
        
        // Cek laporan baru dalam 7 hari terakhir
        $laporanBaru = NomorSk::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->where('tglsk', '>=', Carbon::now()->subDays(7))
            ->count() +
            NomorPerbup::where('kodeopd', $opdId)
            ->where('status', 'selesai') 
            ->where('tglpb', '>=', Carbon::now()->subDays(7))
            ->count();
            
        if ($laporanBaru > 0) {
            $notifikasi[] = [
                'type' => 'success',
                'icon' => 'fas fa-check-circle',
                'message' => "Ada {$laporanBaru} laporan baru yang sudah selesai dalam 7 hari terakhir"
            ];
        }
        
        // Cek laporan yang sudah lama dalam proses
        $prosesLama = ProsesSk::where('kodeopd', $opdId)
            ->where('status', 'Proses')
            ->where('tglmasuksk', '<=', Carbon::now()->subDays(30))
            ->count();
            
        if ($prosesLama > 0) {
            $notifikasi[] = [
                'type' => 'warning',
                'icon' => 'fas fa-clock',
                'message' => "Ada {$prosesLama} laporan yang sudah dalam proses lebih dari 30 hari"
            ];
        }
        
        // Cek laporan belum diambil
        $belumDiambil = NomorSk::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->whereNull('tglambilsk')
            ->count();
            
        if ($belumDiambil > 0) {
            $notifikasi[] = [
                'type' => 'info',
                'icon' => 'fas fa-download',
                'message' => "Ada {$belumDiambil} laporan yang sudah selesai namun belum dicetak/diambil"
            ];
        }
        
        return $notifikasi;
    }
    
    private function getFilterData()
    {
        return [
            'periode' => [
                'hari_ini' => 'Hari Ini',
                'minggu_ini' => 'Minggu Ini', 
                'bulan_ini' => 'Bulan Ini',
                'tahun_ini' => 'Tahun Ini',
                'semua' => 'Semua Periode'
            ],
            'jenis_laporan' => [
                'semua' => 'Semua Jenis',
                'SK' => 'Surat Keputusan',
                'Perbup' => 'Peraturan Bupati',
                'SK Proses' => 'SK Dalam Proses',
                'Perbup Proses' => 'Perbup Dalam Proses',
                'SK Lainnya' => 'SK Lainnya'
            ],
            'kategori' => [
                'semua' => 'Semua Status',
                'selesai' => 'Sudah Selesai',
                'proses' => 'Dalam Proses'
            ]
        ];
    }
    
    public function cetakTahunan(Request $request)
    {
        $user = Auth::user();
        $tahun = $request->get('tahun', date('Y'));
        $jenis = $request->get('jenis', 'semua');
        
        // Generate laporan tahunan berdasarkan filter
        $data = $this->getDataTahunan($user->opd_id, $tahun, $jenis);
        
        return view('user.cetak-tahunan', compact('data', 'tahun', 'jenis', 'user'));
    }
    
    private function getDataTahunan($opdId, $tahun, $jenis)
    {
        $data = [];
        
        if ($jenis == 'semua' || $jenis == 'sk') {
            $data['sk'] = NomorSk::where('kodeopd', $opdId)
                ->whereYear('tglsk', $tahun)
                ->orderBy('tglsk', 'asc')
                ->get();
        }
        
        if ($jenis == 'semua' || $jenis == 'perbup') {
            $data['perbup'] = NomorPerbup::where('kodeopd', $opdId)
                ->whereYear('tglpb', $tahun)
                ->orderBy('tglpb', 'asc')
                ->get();
        }
        
        if ($jenis == 'semua' || $jenis == 'sk_lainnya') {
            $data['sk_lainnya'] = ProsesLain::where('kodeopd', $opdId)
                ->whereYear('tglmasuk', $tahun)
                ->orderBy('tglmasuk', 'asc')
                ->get();
        }
        
        return $data;
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();
            
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $user->id,
                'whatsapp' => 'nullable|string|max:15',
                'old_password' => 'nullable|string',
                'new_password' => 'nullable|string|min:8|confirmed',
            ]);
            
            $updateData = [
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
            ];
            
            // Check if password update is requested
            if ($request->filled('new_password')) {
                if (!$request->filled('old_password')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Password lama harus diisi untuk mengubah password'
                    ]);
                }
                
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Password lama tidak sesuai'
                    ]);
                }
                
                $updateData['password'] = Hash::make($request->new_password);
            }
            
            $user->update($updateData);
            
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function getNotifications()
    {
        $user = Auth::user();
        $opdId = $user->opd_id;
        
        // Get recent notifications
        $notifications = $this->getNotifikasi($opdId);
        
        // Count new items since last check (you might want to implement a last_check timestamp)
        $newCount = 0;
        
        // Check for new completed documents in last hour
        $recentCompleted = NomorSk::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->where('updated_at', '>=', Carbon::now()->subHour())
            ->count() +
            NomorPerbup::where('kodeopd', $opdId)
            ->where('status', 'selesai')
            ->where('updated_at', '>=', Carbon::now()->subHour())
            ->count();
            
        $newCount = $recentCompleted;
        
        return response()->json([
            'notifications' => $notifications,
            'newCount' => $newCount
        ]);
    }
}