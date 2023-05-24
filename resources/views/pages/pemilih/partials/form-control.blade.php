<div class="card-body">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form-group">
        <label for="id_propinsi">Propinsi</label>
        <select class="form-control select2" name="id_propinsi" style="width: 100%;">
            <option value="" selected disabled>Pilih satu</option>
            @foreach($propinsis as $propinsi)
            <option @if($item->id_propinsi == $propinsi->id || old('id_propinsi') == $propinsi->id) selected @endif value="{{ $propinsi->id }}">{{ $propinsi->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="id_kabupaten">Kabupaten</label>
        <select class="form-control select2" name="id_kabupaten" style="width: 100%;">
        </select>
    </div>
    <div class="form-group">
        <label for="id_kecamatan">Kecamatan</label>
        <select class="form-control select2" name="id_kecamatan" style="width: 100%;">
        </select>
    </div>
    <div class="form-group">
        <label for="id_kelurahan">Kelurahan</label>
        <select class="form-control select2" name="id_kelurahan" style="width: 100%;">
        </select>
    </div>
    <div class="form-group">
        <label for="id_tps">TPS</label>
        <select class="form-control select2" name="id_tps" style="width: 100%;">
            
        </select>
    </div>
    <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" class="form-control" id="nik" name="nik" placeholder="nik" value="{{ old('nik') ?? $item->nik }}">
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="{{ old('nama') ?? $item->nama }}">
    </div>
    <div class="form-group">
        <label for="jk">P/L</label>
        <input type="radio" id="jk" name="jk" value="P" {{ $item->jk == 'P' ? 'checked' : '' }} checked> Perempuan
        <input type="radio" id="jk" name="jk" value="L" {{ $item->jk == 'L' ? 'checked' : '' }}> Laki-laki
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" value="{{ old('alamat') ?? $item->alamat }}">
    </div>
    <div class="form-group">
        <label for="tgl_lahir">Tgl. Lahir</label>
        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="YYYY-MM-DD" value="{{ old('tgl_lahir') ?? $item->tgl_lahir }}">
    </div>
    @if(Storage::disk('public')->exists($item->image ?? null))
    <img src="{{ Storage::url($item->image ?? null) }}" width="200px" />
    @endif
    <div class="form-group">
        <label for="image">KTP(JPG,JPEG)</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>