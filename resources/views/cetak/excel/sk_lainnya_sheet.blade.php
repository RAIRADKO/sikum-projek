{{-- resources/views/cetak/excel/sk_lainnya_sheet.blade.php --}}
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>KODE</th>
            <th>TGL MASUK</th>
            <th>JUDUL</th>
            <th>OPD</th>
            <th>TGL KABAG</th>
            <th>TGL ASISTEN</th>
            <th>ASISTEN</th>
            <th>TGL TURUN</th>
            <th>TGL AMBIL</th>
            <th>PENGAMBIL</th>
            <th>KET</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sk_lainnya as $index => $lainnya)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $lainnya->kodelain ?? '' }}</td>
            <td>{{ $lainnya->tglmasuk ? date('d/m/Y', strtotime($lainnya->tglmasuk)) : '' }}</td>
            <td>{{ $lainnya->judul ?? '' }}</td>
            <td>{{ $lainnya->opd->namaopd ?? '' }}</td>
            <td>{{ $lainnya->tglnaikkabag ? date('d/m/Y', strtotime($lainnya->tglnaikkabag)) : '' }}</td>
            <td>{{ $lainnya->tglnaikass ? date('d/m/Y', strtotime($lainnya->tglnaikass)) : '' }}</td>
            <td>{{ $lainnya->asisten->namaass ?? '' }}</td>
            <td>{{ $lainnya->tglturun ? date('d/m/Y', strtotime($lainnya->tglturun)) : '' }}</td>
            <td>{{ $lainnya->tglambil ? date('d/m/Y', strtotime($lainnya->tglambil)) : '' }}</td>
            <td>{{ $lainnya->namaambil ?? '' }}</td>
            <td>{{ $lainnya->ket ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>