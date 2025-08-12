<!DOCTYPE html>
<html lang="id">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cetak Kartu Nomor Peraturan Bupati - {{ $perbup->nopb }}</title>
<style>
    body {
        font-family: "Times New Roman", serif;
        font-size: 11pt;
        margin: 0;
        padding: 15px;
        background: white;
    }

    @page {
        size: A4 landscape;
        margin: 1.5cm 1cm 2cm 2cm;
    }

    .container {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 20px;
    }

    .card-wrapper {
        display: flex;
        width: 100%;
        max-width: 750px;
        border: none;
    }

    .card {
        width: 47.5%;
        padding: 20px 15px;
        box-sizing: border-box;
    }

    .divider {
        width: 5%;
        border-right: 2px solid black;
        margin: 0 10px;
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 13pt;
        margin-bottom: 25px;
        line-height: 1.4;
        letter-spacing: 0.5px;
    }

    .info-table {
        width: 100%;
        margin-bottom: 20px;
    }

    .info-table tr {
        height: 25px;
    }

    .info-table td {
        vertical-align: top;
        padding: 2px 0;
        font-size: 11pt;
    }

    .info-label {
        width: 35%;
        white-space: nowrap;
        font-weight: normal;
    }

    .info-separator {
        width: 3%;
        text-align: center;
    }

    .info-value {
        width: 62%;
        word-wrap: break-word;
    }

    .berita-daerah {
        margin: 25px 0;
        font-size: 11pt;
        line-height: 1.3;
    }

    .tanda-terima {
        text-align: center;
        margin-top: 30px;
    }

    .tanda-terima-title {
        margin-bottom: 10px;
        font-size: 11pt;
    }

    .tanda-terima-tanggal {
        margin-bottom: 15px;
    }

    .signature-line {
        margin: 15px 0;
        font-size: 11pt;
    }

    .signature-line span {
        display: inline-block;
        width: 120px;
        border-bottom: 1px solid black;
        margin: 0 5px;
    }

    .kode {
        font-size: 10pt;
        margin-top: 10px;
    }

    .footer {
        font-style: italic;
        font-size: 10pt;
        text-align: center;
        margin-top: 30px;
        position: absolute;
        bottom: 15px;
        width: calc(47.5% - 30px);
    }

    .card-left .footer {
        left: 15px;
    }

    .card-right .footer {
        right: 15px;
    }

    .card-right {
        position: relative;
    }

    @media print {
        body {
            margin: 0;
            padding: 0;
        }
        
        .container {
            height: auto;
            padding-top: 0;
        }
        
        .footer {
            position: static;
            margin-top: 20px;
        }
    }
</style>
</head>
<body onload="window.print()">

<div class="container">
    <div class="card-wrapper">
        <!-- Kartu Kiri -->
        <div class="card card-left">
            <div class="title">
                KARTU NOMOR<br>
                PERATURAN BUPATI PURWOREJO
            </div>

            <table class="info-table">
                <tr>
                    <td class="info-label">NOMOR PERBUP</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->nopb }} TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">TANGGAL PERBUP</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">JUDUL PERBUP</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->judulpb }}</td>
                </tr>
                <tr>
                    <td class="info-label">DINAS/OPD</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->opd->namaopd ?? 'BAPPERIDA' }}</td>
                </tr>
                <tr>
                    <td class="info-label">TGL PENGUNDANGAN</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->format('d-m-Y') : '01-08-2025' }}</td>
                </tr>
            </table>

            <div class="berita-daerah">
                BERITA DAERAH TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }} NO {{ $perbup->nopb }} SERI {{ $perbup->seri ?? 'E' }} NO {{ $perbup->noseri ?? '19' }}
            </div>

            <div class="footer">
                Lembar untuk OPD Pemrakarsa
            </div>
        </div>

        <!-- Garis Pemisah -->
        <div class="divider"></div>

        <!-- Kartu Kanan -->
        <div class="card card-right">
            <div class="title">
                KARTU NOMOR<br>
                PERATURAN BUPATI PURWOREJO
            </div>

            <table class="info-table">
                <tr>
                    <td class="info-label">NOMOR PERBUP</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->nopb }} TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">TANGGAL PERBUP</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">JUDUL PERBUP</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->judulpb }}</td>
                </tr>
                <tr>
                    <td class="info-label">DINAS/OPD</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->opd->namaopd ?? 'BAPPERIDA' }}</td>
                </tr>
                <tr>
                    <td class="info-label">TGL PENGUNDANGAN</td>
                    <td class="info-separator">:</td>
                    <td class="info-value">{{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->format('d-m-Y') : '01-08-2025' }}</td>
                </tr>
            </table>

            <div class="berita-daerah">
                BERITA DAERAH TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }} NO {{ $perbup->nopb }} SERI {{ $perbup->seri ?? 'E' }} NO {{ $perbup->noseri ?? '19' }}
            </div>

            <div class="tanda-terima">
                <div class="tanda-terima-title">TANDA TERIMA AMBIL</div>
                <div class="tanda-terima-tanggal">TANGGAL</div>
                <div class="signature-line">( <span></span> )</div>
                <div class="kode">PB{{ str_pad($perbup->nopb, 4, '0', STR_PAD_LEFT) }}/{{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</div>
            </div>

            <div class="footer">
                Lembar untuk Bagian Hukum
            </div>
        </div>
    </div>
</div>

</body>
</html>