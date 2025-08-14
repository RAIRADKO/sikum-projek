{{-- resources/views/cetak/excel/perbup_sheet.blade.php --}}
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>TGL</th>
            <th>JUDUL</th>
            <th>OPD</th>
            <th>TGL TURUN</th>
            <th>SERI</th>
            <th>NO SERI</th>
            <th>TGL UNDANG</th>
            <th>TGL AMBIL</th>
            <th>PENGAMBIL</th>
            <th>TGL BON</th>
            <th>PENGEBON</th>
            <th>ALASAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nomor_perbup as $index => $perbup)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $perbup->tglpb ? date('d/m/Y', strtotime($perbup->tglpb)) : '' }}</td>
            <td>{{ $perbup->judulpb ?? '' }}</td>
            <td>{{ $perbup->opd->namaopd ?? '' }}</td>
            <td>{{ $perbup->tglturunpb ? date('d/m/Y', strtotime($perbup->tglturunpb)) : '' }}</td>
            <td>{{ $perbup->seri ?? '' }}</td>
            <td>{{ $perbup->noseri ?? '' }}</td>
            <td>{{ $perbup->tglpengundangan ? date('d/m/Y', strtotime($perbup->tglpengundangan)) : '' }}</td>
            <td>{{ $perbup->tglambilpb ? date('d/m/Y', strtotime($perbup->tglambilpb)) : '' }}</td>
            <td>{{ $perbup->namapengambilpb ?? '' }}</td>
            <td>{{ $perbup->tglbon ? date('d/m/Y', strtotime($perbup->tglbon)) : '' }}</td>
            <td>{{ $perbup->namabon ?? '' }}</td>
            <td>{{ $perbup->alasanbonpb ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>