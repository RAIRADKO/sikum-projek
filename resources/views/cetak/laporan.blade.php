<!DOCTYPE html>
<html>
<head>
    <title>Laporan {{ ucfirst(str_replace('_', ' ', $jenis_dokumen)) }} Tahun {{ $tahun }}</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            font-size: 10px;
            margin: 0;
            padding: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header h2 {
            font-size: 14px;
            margin: 5px 0;
            font-weight: normal;
        }
        .header .info {
            font-size: 12px;
            margin-top: 10px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
            font-size: 9px;
        }
        th, td { 
            border: 1px solid #333; 
            padding: 4px 6px; 
            text-align: left; 
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 8px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
            padding: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
        .page-break {
            page-break-before: always;
        }
        
        /* Responsive column widths */
        .col-no { width: 3%; }
        .col-tgl { width: 8%; }
        .col-judul { width: 25%; }
        .col-opd { width: 15%; }
        .col-seri { width: 5%; }
        .col-noseri { width: 5%; }
        .col-pengambil { width: 12%; }
        .col-ket { width: 15%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pemerintah Kabupaten Purworejo</h1>
        <h2>Bagian Hukum Sekretariat Daerah</h2>
        <div class="info">
            Laporan {{ ucfirst(str_replace('_', ' ', $jenis_dokumen)) }} Tahun {{ $tahun }}<br>
            Dicetak pada: {{ date('d/m/Y H:i:s') }}
        </div>
    </div>

    @if (!empty($nomor_sk))
        <h3 style="margin-top: 0;">LAPORAN NOMOR SURAT KEPUTUSAN TAHUN {{ $tahun }}</h3>
        @if(count($nomor_sk) > 0)
            <table>
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-tgl">TGL</th>
                        <th class="col-judul">JUDUL</th>
                        <th class="col-opd">OPD</th>
                        <th class="col-tgl">TGL TURUN</th>
                        <th class="col-tgl">TGL AMBIL</th>
                        <th class="col-pengambil">PENGAMBIL</th>
                        <th class="col-tgl">TGL BON</th>
                        <th class="col-pengambil">PENGEBON</th>
                        <th class="col-ket">ALASAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nomor_sk as $index => $sk)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $sk->tglsk ? date('d/m/Y', strtotime($sk->tglsk)) : '' }}</td>
                        <td>{{ $sk->judulsk ?? '' }}</td>
                        <td>{{ $sk->opd->namaopd ?? '' }}</td>
                        <td class="text-center">{{ $sk->tglturunsk ? date('d/m/Y', strtotime($sk->tglturunsk)) : '' }}</td>
                        <td class="text-center">{{ $sk->tglambilsk ? date('d/m/Y', strtotime($sk->tglambilsk)) : '' }}</td>
                        <td>{{ $sk->namapengambilsk ?? '' }}</td>
                        <td class="text-center">{{ $sk->tglbon ? date('d/m/Y', strtotime($sk->tglbon)) : '' }}</td>
                        <td>{{ $sk->namabon ?? '' }}</td>
                        <td>{{ $sk->alasanbonsk ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><strong>Total SK: {{ count($nomor_sk) }}</strong></p>
        @else
            <div class="no-data">Tidak ada data Surat Keputusan untuk tahun {{ $tahun }}</div>
        @endif
    @endif

    @if (!empty($nomor_perbup))
        @if (!empty($nomor_sk))
            <div class="page-break"></div>
        @endif
        <h3 style="margin-top: 0;">LAPORAN NOMOR PERATURAN BUPATI TAHUN {{ $tahun }}</h3>
        @if(count($nomor_perbup) > 0)
            <table>
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-tgl">TGL</th>
                        <th class="col-judul">JUDUL</th>
                        <th class="col-opd">OPD</th>
                        <th class="col-tgl">TGL TURUN</th>
                        <th class="col-seri">SERI</th>
                        <th class="col-noseri">NO SERI</th>
                        <th class="col-tgl">TGL UNDANG</th>
                        <th class="col-tgl">TGL AMBIL</th>
                        <th class="col-pengambil">PENGAMBIL</th>
                        <th class="col-tgl">TGL BON</th>
                        <th class="col-pengambil">PENGEBON</th>
                        <th class="col-ket">ALASAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nomor_perbup as $index => $perbup)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $perbup->tglpb ? date('d/m/Y', strtotime($perbup->tglpb)) : '' }}</td>
                        <td>{{ $perbup->judulpb ?? '' }}</td>
                        <td>{{ $perbup->opd->namaopd ?? '' }}</td>
                        <td class="text-center">{{ $perbup->tglturunpb ? date('d/m/Y', strtotime($perbup->tglturunpb)) : '' }}</td>
                        <td class="text-center">{{ $perbup->seri ?? '' }}</td>
                        <td class="text-center">{{ $perbup->noseri ?? '' }}</td>
                        <td class="text-center">{{ $perbup->tglpengundangan ? date('d/m/Y', strtotime($perbup->tglpengundangan)) : '' }}</td>
                        <td class="text-center">{{ $perbup->tglambilpb ? date('d/m/Y', strtotime($perbup->tglambilpb)) : '' }}</td>
                        <td>{{ $perbup->namapengambilpb ?? '' }}</td>
                        <td class="text-center">{{ $perbup->tglbon ? date('d/m/Y', strtotime($perbup->tglbon)) : '' }}</td>
                        <td>{{ $perbup->namabon ?? '' }}</td>
                        <td>{{ $perbup->alasanbonpb ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><strong>Total Perbup: {{ count($nomor_perbup) }}</strong></p>
        @else
            <div class="no-data">Tidak ada data Peraturan Bupati untuk tahun {{ $tahun }}</div>
        @endif
    @endif

    @if (!empty($sk_lainnya))
        @if (!empty($nomor_sk) || !empty($nomor_perbup))
            <div class="page-break"></div>
        @endif
        <h3 style="margin-top: 0;">LAPORAN SK LAINNYA TAHUN {{ $tahun }}</h3>
        @if(count($sk_lainnya) > 0)
            <table>
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-seri">KODE</th>
                        <th class="col-tgl">TGL MASUK</th>
                        <th class="col-judul">JUDUL</th>
                        <th class="col-opd">OPD</th>
                        <th class="col-tgl">TGL KABAG</th>
                        <th class="col-tgl">TGL ASISTEN</th>
                        <th class="col-pengambil">ASISTEN</th>
                        <th class="col-tgl">TGL TURUN</th>
                        <th class="col-tgl">TGL AMBIL</th>
                        <th class="col-pengambil">PENGAMBIL</th>
                        <th class="col-ket">KET</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sk_lainnya as $index => $lainnya)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $lainnya->kodelain ?? '' }}</td>
                        <td class="text-center">{{ $lainnya->tglmasuk ? date('d/m/Y', strtotime($lainnya->tglmasuk)) : '' }}</td>
                        <td>{{ $lainnya->judul ?? '' }}</td>
                        <td>{{ $lainnya->opd->namaopd ?? '' }}</td>
                        <td class="text-center">{{ $lainnya->tglnaikkabag ? date('d/m/Y', strtotime($lainnya->tglnaikkabag)) : '' }}</td>
                        <td class="text-center">{{ $lainnya->tglnaikass ? date('d/m/Y', strtotime($lainnya->tglnaikass)) : '' }}</td>
                        <td>{{ $lainnya->asisten->namaass ?? '' }}</td>
                        <td class="text-center">{{ $lainnya->tglturun ? date('d/m/Y', strtotime($lainnya->tglturun)) : '' }}</td>
                        <td class="text-center">{{ $lainnya->tglambil ? date('d/m/Y', strtotime($lainnya->tglambil)) : '' }}</td>
                        <td>{{ $lainnya->namaambil ?? '' }}</td>
                        <td>{{ $lainnya->ket ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><strong>Total SK Lainnya: {{ count($sk_lainnya) }}</strong></p>
        @else
            <div class="no-data">Tidak ada data SK Lainnya untuk tahun {{ $tahun }}</div>
        @endif
    @endif

    <div class="footer">
        <div style="margin-top: 40px;">
            <div style="float: left;">
                <p>Purworejo, {{ date('d F Y') }}</p>
            </div>
            <div style="float: right;">
                <p>Kepala Bagian Hukum</p>
                <br><br><br>
                <p style="text-decoration: underline;">_________________________</p>
                <p>NIP. ___________________</p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
</body>
</html>