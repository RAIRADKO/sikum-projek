<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tahun {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Nomor SK Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No SK</th>
                <th>Tanggal</th>
                <th>Judul</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nomor_sk as $sk)
            <tr>
                <td>{{ $sk->nosk }}</td>
                <td>{{ $sk->tglsk }}</td>
                <td>{{ $sk->judulsk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Laporan Nomor Perbup Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No Perbup</th>
                <th>Tanggal</th>
                <th>Judul</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nomor_perbup as $perbup)
            <tr>
                <td>{{ $perbup->nopb }}</td>
                <td>{{ $perbup->tglpb }}</td>
                <td>{{ $perbup->judulpb }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Laporan SK Lainnya Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal Masuk</th>
                <th>Judul</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sk_lainnya as $lainnya)
            <tr>
                <td>{{ $lainnya->kodelain }}</td>
                <td>{{ $lainnya->tglmasuk }}</td>
                <td>{{ $lainnya->judul }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>