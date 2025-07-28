<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama:</strong>
            <input type="text" name="nama" value="{{ old('nama', $asisten->nama ?? '') }}" class="form-control" placeholder="Nama">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>NIM:</strong>
            <input type="text" name="nim" value="{{ old('nim', $asisten->nim ?? '') }}" class="form-control" placeholder="NIM">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Jabatan:</strong>
            <input type="text" name="jabatan" value="{{ old('jabatan', $asisten->jabatan ?? '') }}" class="form-control" placeholder="Jabatan">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>