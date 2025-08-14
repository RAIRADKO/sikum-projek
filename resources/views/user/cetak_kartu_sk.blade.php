<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Kartu Nomor SK - {{ $sk->nosk }}</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            width: 100%;
            height: 100%;
        }
        .column {
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .column + .column {
            border-left: 1px solid #000;
        }
        .title {
            text-align: center;
            font-weight: bold;
        }
        .data-table {
            margin-top: 20px;
            width: 100%;
        }
        .data-table td {
            vertical-align: top;
            padding: 3px;
        }
        .footer {
            text-align: right;
            font-size: 14px;
            margin-top: 40px;
        }
        .ttd {
            text-align: right; 
        }
        .ttd p {
            margin: 6px 0;
        }
        .kode-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 14px;
            margin-top: 40px;
        }
        .paraf {
            display: inline-block;
            min-width: 120px; 
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">
    <!-- Kolom Kiri -->
    <div class="column">
        <div>
            <div class="title">
                KARTU NOMOR <br>
                KEPUTUSAN BUPATI PURWOREJO
            </div>
            <table class="data-table">
                <tr>
                    <td width="120">NOMOR SK</td>
                    <td width="10">:</td>
                    <td>{{ $sk->nosk }}</td>
                </tr>
                <tr>
                    <td>TANGGAL SK</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>JUDUL SK</td>
                    <td>:</td>
                    <td>{{ $sk->judulsk }}</td>
                </tr>
                <tr>
                    <td>DINAS/OPD</td>
                    <td>:</td>
                    <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            Lembar untuk OPD Pemrakarsa
        </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="column">
        <div>
            <div class="title">
                KARTU NOMOR <br>
                KEPUTUSAN BUPATI PURWOREJO
            </div>
            <table class="data-table">
                <tr>
                    <td width="120">NOMOR SK</td>
                    <td width="10">:</td>
                    <td>{{ $sk->nosk }}</td>
                </tr>
                <tr>
                    <td>TANGGAL SK</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>JUDUL SK</td>
                    <td>:</td>
                    <td>{{ $sk->judulsk }}</td>
                </tr>
                <tr>
                    <td>DINAS/OPD</td>
                    <td>:</td>
                    <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                </tr>
            </table>

            <div class="ttd">
                <p>TANDA TERIMA AMBIL</p>
                <p>TANGGAL</p>
                <br><br>
                <p>(<span class="paraf"></span>)</p>
            </div>
        </div>

        <div class="kode-footer">
            <span>{{ $sk->kodesk ?? 'SK' . str_pad($sk->nosk, 4, '0', STR_PAD_LEFT) }}/{{ \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') }}</span>
            <span class="footer">Lembar untuk Bagian Hukum</span>
        </div>
    </div>
</div>

</body>
</html>