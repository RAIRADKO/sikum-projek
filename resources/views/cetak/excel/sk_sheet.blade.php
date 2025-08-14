{{-- resources/views/cetak/excel/sk_sheet.blade.php --}}
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>TGL</th>
            <th>JUDUL</th>
            <th>OPD</th>
            <th>TGL TURUN</th>
            <th>TGL AMBIL</th>
            <th>PENGAMBIL</th>
            <th>TGL BON</th>
            <th>PENGEBON</th>
            <th>ALASAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nomor_sk as $index => $sk)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $sk->tglsk ? date('d/m/Y', strtotime($sk->tglsk)) : '' }}</td>
            <td>{{ $sk->judulsk ?? '' }}</td>
            <td>{{ $sk->opd->namaopd ?? '' }}</td>
            <td>{{ $sk->tglturunsk ? date('d/m/Y', strtotime($sk->tglturunsk)) : '' }}</td>
            <td>{{ $sk->tglambilsk ? date('d/m/Y', strtotime($sk->tglambilsk)) : '' }}</td>
            <td>{{ $sk->namapengambilsk ?? '' }}</td>
            <td>{{ $sk->tglbon ? date('d/m/Y', strtotime($sk->tglbon)) : '' }}</td>
            <td>{{ $sk->namabon ?? '' }}</td>
            <td>{{ $sk->alasanbonsk ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>