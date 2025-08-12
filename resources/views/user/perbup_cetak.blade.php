<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cetak Kartu Nomor Peraturan Bupati - {{ $perbup->nopb }}</title>
    <style>
        /* Font Definitions */
        @font-face {
            font-family: "Bookman Old Style";
            panose-1: 2 5 6 4 5 5 5 2 2 4;
        }

        /* Style Definitions */
        p, li, div {
            margin: 0;
            margin-bottom: .0001pt;
            font-size: 12.0pt;
            font-family: "Bookman Old Style", serif;
        }

        .MsoTableGrid {
            border-collapse: collapse;
            border: none;
            width: 100%;
        }

        td {
            padding: 5px;
            vertical-align: top;
        }

        p {
            line-height: 1.5; /* Menambah jarak antar baris agar lebih mudah dibaca */
            text-align: justify;
        }

        .card-container {
            padding: 1cm;
            border: 1px solid black;
            height: 13cm; /* Menyesuaikan tinggi kartu */
            display: flex;
            flex-direction: column;
        }

        .card-footer {
            margin-top: auto; /* Mendorong footer ke bagian bawah kartu */
        }

        /* Page Definitions */
        @page {
            size: 21.0cm 29.7cm; /* Ukuran A4 */
            margin: 1cm;
        }

        .WordSection1 {
            page: WordSection1;
        }

        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="WordSection1">
    <table class="MsoTableGrid">
        <tr>
            <td style="width: 48%; padding-right: 2%;">
                <div class="card-container">
                    <p style="text-align:center;"><b>KARTU NOMOR</b></p>
                    <p style="text-align:center;"><b>PERATURAN BUPATI PURWOREJO</b></p>
                    <br>
                    <table>
                        <tr>
                            <td style="width: 150px;">NOMOR PERBUP</td>
                            <td>: {{ $perbup->nopb }} TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }}</td>
                        </tr>
                        <tr>
                            <td>TANGGAL PERBUP</td>
                            <td>: {{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>JUDUL PERBUP</td>
                            <td>: {{ $perbup->judulpb }}</td>
                        </tr>
                        <tr>
                            <td>OPD PEMRAKARSA</td>
                            <td>: {{ $perbup->opd->namaopd ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>TGL PENGUNDANGAN</td>
                            <td>: {{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->format('d-m-Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                BERITA DAERAH TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }} NOMOR {{ $perbup->nopb }} SERI {{ $perbup->seri }} NOMOR {{ $perbup->noseri }}
                            </td>
                        </tr>
                    </table>
                    <div class="card-footer">
                        <p style="text-align:right;"><i>Lembar untuk OPD Pemrakarsa</i></p>
                    </div>
                </div>
            </td>

            <td style="width: 48%; padding-left: 2%;">
                <div class="card-container">
                    <p style="text-align:center;"><b>KARTU NOMOR</b></p>
                    <p style="text-align:center;"><b>PERATURAN BUPATI PURWOREJO</b></p>
                    <br>
                    <table>
                        <tr>
                            <td style="width: 150px;">NOMOR PERBUP</td>
                            <td>: {{ $perbup->nopb }} TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }}</td>
                        </tr>
                        <tr>
                            <td>TANGGAL PERBUP</td>
                            <td>: {{ \Carbon\Carbon::parse($perbup->tglpb)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>JUDUL PERBUP</td>
                            <td>: {{ $perbup->judulpb }}</td>
                        </tr>
                        <tr>
                            <td>OPD PEMRAKARSA</td>
                            <td>: {{ $perbup->opd->namaopd ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>TGL PENGUNDANGAN</td>
                            <td>: {{ $perbup->tglpengundangan ? \Carbon\Carbon::parse($perbup->tglpengundangan)->format('d-m-Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                BERITA DAERAH TAHUN {{ \Carbon\Carbon::parse($perbup->tglpb)->format('Y') }} NOMOR {{ $perbup->nopb }} SERI {{ $perbup->seri }} NOMOR {{ $perbup->noseri }}
                            </td>
                        </tr>
                    </table>
                    <div class="card-footer">
                         <p style="text-align:center;">TANDA TERIMA AMBIL</p>
                         <br><br>
                         <p>TANGGAL: ...........................................</p>
                        <p style="text-align:right;"><i>Lembar untuk Bagian Hukum</i></p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>