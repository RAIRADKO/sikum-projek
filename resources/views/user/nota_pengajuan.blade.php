@extends('layouts.app')

@section('title', 'Nota Pengajuan SK')

@push('styles')
<style>
    .nota-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 40px;
        margin: 20px 0;
    }
    .nota-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .nota-table td:first-child {
        width: 180px;
        font-weight: 600;
        color: #495057;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-2" style="min-height: 500px;">
            <div class="card nota-card">
                <div class="nota-header text-center">
                    <h2>NOTA PENGAJUAN</h2>
                </div>
                <div class="card-body">
                    <form name="form1" method="post" action="cetaknpsk.php">
                        <div class="table-responsive">
                            <table class="table table-bordered nota-table">
                                <tr>
                                    <td width="20%">Ditujukan Kepada</td>
                                    <td width="3%">:</td>
                                    <td colspan="2"><input name="tkpd" type="text" id="tkpd" class="form-control" value="Bupati Purworejo"></td>
                                </tr>
                                <tr>
                                    <td>Melalui</td>
                                    <td>:</td>
                                    <td colspan="2"><input name="tmll" type="text" id="tmll" class="form-control" value="Wakil Bupati Purworejo"></td>
                                </tr>
                                <tr>
                                    <td>Lewat</td>
                                    <td>:</td>
                                    <td width="7%"><input name="tnomor" type="text" id="tnomor" class="form-control" value="1."></td>
                                    <td><input name="tlwt" type="text" id="tlwt" class="form-control" value="Sekretaris Daerah Kab. Purworejo."></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><input name="tnomor2" type="text" id="tnomor2" class="form-control" value="2."></td>
                                    <td><input name="tlwt2" type="text" id="tlwt2" class="form-control" value="{{ $row['namaass'] ?? '' }} Setda Kab.Purworejo."></td>
                                </tr>
                                <tr>
                                    <td>Dari</td>
                                    <td>:</td>
                                    <td colspan="2"><input name="tdari" type="text" id="tdari" class="form-control" value="Bagian Hukum Setda Kab.Purworejo"></td>
                                </tr>
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td colspan="2"><input name="tjudul2" type="text" id="tjudul2" class="form-control" value="Keputusan Bupati Purworejo tentang"><input name="tjudul" type="text" id="tjudul" class="form-control" value="{{ $data['judulsk'] ?? '' }}" readonly></td>
                                </tr>
                                <tr>
                                    <td>Mohon untuk</td>
                                    <td>:</td>
                                    <td colspan="2"><input name="tmohon" type="text" id="tmohon" class="form-control" value="Tapak Asman"></td>
                                </tr>
                                <tr>
                                    <td>Tanda Tangan</td>
                                    <td>:</td>
                                    <td colspan="2"><input name="tttd" type="text" id="tttd" class="form-control" value="{{ $data['jmlttdsk'] ?? '' }} kali" readonly></td>
                                </tr>
                                <tr>
                                    <td>Lain-lain</td>
                                    <td>:</td>
                                    <td width="2%"><input name="t" type="text" id="t" class="form-control" value="-"></td>
                                    <td><input name="tlain" type="text" id="tlain" class="form-control" value="Materi dari {{ $data['kodeopd'] ?? '' }} Kab. Purworejo."></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="2%"><input name="t2" type="text" id="t2" class="form-control" value="-"></td>
                                    <td><input name="tlain2" type="text" id="tlain2" class="form-control" value="Tata Naskah telah mendapatkan koreksi dan revisi dari Bagian Hukum Setda Kab.Purworejo."></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="2%"><input name="t3" type="text" id="t3" class="form-control" value=""></td>
                                    <td><input name="tlain3" type="text" id="tlain3" class="form-control" value=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><input name="ttgl" type="text" id="ttgl" class="form-control" value="Purworejo, {{ date('j F Y') }}"></td>
                                </tr>
                                <tr><td></td><td></td><td></td><td></td></tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><input name="tkabag" type="text" id="tkabag" class="form-control" value="KEPALA BAGIAN HUKUM"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><input name="tkabag2" type="text" id="tkabag2" class="form-control" value="SETDA KABUPATEN PURWOREJO"></td>
                                </tr>
                                <tr><td></td><td></td><td colspan="2"></td></tr>
                                <tr><td></td><td></td><td colspan="2"></td></tr>
                                <tr><td></td><td></td><td colspan="2"></td></tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><input name="tkabag3" type="text" id="tkabag3" class="form-control" value="PUGUH TRIHATMOKO, SH, MH"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><input name="tkabag4" type="text" id="tkabag4" class="form-control" value="Pembina Tk I"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><input name="tnip" type="text" id="tnip" class="form-control" value="NIP. 19750829 199903 1 005"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="tkode" type="hidden" id="tkode" value="{{ $data['kodesk'] ?? '' }}">
                                        <input name="tno" type="hidden" id="tno" value="{{ $data['nosk'] ?? '' }}">
                                    </td>
                                    <td></td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <button type="submit" class="btn btn-primary" name="btncetak"><i class="fa fa-print"></i> Cetak</button>
                                        <a href="dataprosesskuserhukum.php" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection