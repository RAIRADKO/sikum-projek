<!DOCTYPE html>
<html lang="id">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cetak Kartu Nomor Peraturan Bupati - {{ $perbup->nopb }}</title>
<style>
    body {
        font-family: "Bookman Old Style", serif;
        font-size: 12pt;
        margin: 0;
        padding: 0;
    }

    @page {
        size: A4 landscape;
        margin: 1.5cm 1cm 2cm 2cm;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 0.2cm;
        vertical-align: top;
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        margin-bottom: 0.5cm;
        line-height: 1.3;
    }

    .divider {
        border-right: 1px solid black;
        width: 47.15pt;
    }

    .info-label {
        white-space: nowrap;
    }

    .berita-daerah {
        margin-top: 0.3cm;
    }

    .tanda-terima {
        text-align: center;
        margin-top: 0.5cm;
    }

    .tanda-terima-title {
        margin-bottom: 0.3cm;
    }

    .signature {
        margin-top: 0.5cm;
    }

    .signature span {
        display: inline-block;
        width: 3cm;
        border-bottom: 1px solid black;
    }

    .kode {
        font-size: 10pt;
        margin-top: 0.2cm;
    }

    .footer {
        font-style: italic;
        font-size: 11pt;
        text-align: right;
        margin-top: 0.5cm;
    }
</style>
</head>
<body onload="window.print()">

<table>
    <tr>
        <!-- Kartu Kiri -->
        <td width="45%">
            <div class="title">
                KARTU NOMOR<br>
                PERATURAN BUPATI PURWOREJO
            </div>

            <table>
                <tr>
                    <td class="info-label">NOMOR PERBUP</td>
                    <td width="5%">:</td>
                    <td>{{ $perbup->nopb }} TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">TANGGAL PERBUP</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">JUDUL PERBUP</td>
                    <td>:</td>
                    <td>{{ $perbup->judulpb }}</td>
                </tr>
                <tr>
                    <td class="info-label">DINAS/OPD</td>
                    <td>:</td>
                    <td>{{ $perbup->opd->namaopd ?? 'BAPPERIDA' }}</td>
                </tr>
                <tr>
                    <td class="info-label">TGL PENGUNDANGAN</td>
                    <td>:</td>
                    <td>{{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->format('d-m-Y') : '01-08-2025' }}</td>
                </tr>
            </table>

            <div class="berita-daerah">
                BERITA DAERAH TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }} NO {{ $perbup->nopb }} SERI {{ $perbup->seri ?? 'E' }} NO {{ $perbup->noseri ?? '19' }}
            </div>

            <div class="footer">
                Lembar untuk OPD Pemrakarsa
            </div>
        </td>

        <!-- Garis Vertikal Pemisah -->
        <td class="divider"></td>

        <!-- Kartu Kanan -->
        <td width="45%">
            <div class="title">
                KARTU NOMOR<br>
                PERATURAN BUPATI PURWOREJO
            </div>

            <table>
                <tr>
                    <td class="info-label">NOMOR PERBUP</td>
                    <td width="5%">:</td>
                    <td>{{ $perbup->nopb }} TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">TANGGAL PERBUP</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">JUDUL PERBUP</td>
                    <td>:</td>
                    <td>{{ $perbup->judulpb }}</td>
                </tr>
                <tr>
                    <td class="info-label">DINAS/OPD</td>
                    <td>:</td>
                    <td>{{ $perbup->opd->namaopd ?? 'BAPPERIDA' }}</td>
                </tr>
                <tr>
                    <td class="info-label">TGL PENGUNDANGAN</td>
                    <td>:</td>
                    <td>{{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->format('d-m-Y') : '01-08-2025' }}</td>
                </tr>
            </table>

            <div class="berita-daerah">
                BERITA DAERAH TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }} NO {{ $perbup->nopb }} SERI {{ $perbup->seri ?? 'E' }} NO {{ $perbup->noseri ?? '19' }}
            </div>

            <div class="tanda-terima">
                <div class="tanda-terima-title">TANDA TERIMA AMBIL</div>
                <div>TANGGAL</div>
                <div class="signature">( <span></span> )</div>
                <div class="kode">PB0022/08-08-2025</div>
            </div>

            <div class="footer">
                Lembar untuk Bagian Hukum
            </div>
        </td>
    </tr>
</table>

</body>
</html>