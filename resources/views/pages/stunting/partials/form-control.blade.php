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
        <label for="id_puskesmas">Puskesmas</label>
        <select class="form-control select2" name="id_puskesmas" style="width: 100%;">
        </select>
    </div>
    <div class="form-group">
        <label for="id_balita">Balita</label>
        <select class="form-control select2" name="id_balita" style="width: 100%;">
        </select>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="tahun" value="{{ old('tahun') ?? $item->tahun }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="bulan">Bulan</label>
                <input type="number" class="form-control" id="bulan" name="bulan" placeholder="bulan" value="{{ old('bulan') ?? $item->bulan }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="hari">Hari</label>
                <input type="number" class="form-control" id="hari" name="hari" placeholder="hari" value="{{ old('hari') ?? $item->hari }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_pengukuran">Tgl. Pengukuran</label>
        <input type="text" class="form-control" id="tgl_pengukuran" name="tgl_pengukuran" placeholder="YYYY-MM-DD" value="{{ old('tgl_pengukuran') ?? $item->tgl_pengukuran }}">
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="berat">Berat</label>
                <input type="text" class="form-control" id="berat" name="berat" placeholder="berat" value="{{ old('berat') ?? $item->berat }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="tinggi">Tinggi</label>
                <input type="text" class="form-control" id="tinggi" name="tinggi" placeholder="tinggi" value="{{ old('tinggi') ?? $item->tinggi }}">
            </div>
        </div>
    </div>


    <div class="form-group">
        <label for="lila">LiLA</label>
        <input type="text" class="form-control" id="lila" name="lila" placeholder="lila" value="{{ old('lila') ?? $item->lila }}">
    </div>
    <div class="form-group">
        <label for="bb_per_u">BB/U</label>
        <input type="text" class="form-control" id="bb_per_u" name="bb_per_u" placeholder="bb_per_u" value="{{ old('bb_per_u') ?? $item->bb_per_u }}">
    </div>
    <div class="form-group">
        <label for="zs_bb_per_u">ZZ BB/U</label>
        <input type="text" class="form-control" id="zs_bb_per_u" name="zs_bb_per_u" placeholder="zs_bb_per_u" value="{{ old('zs_bb_per_u') ?? $item->zs_bb_per_u }}">
    </div>
    <div class="form-group">
        <label for="tb_per_u">TB/U</label>
        <input type="text" class="form-control" id="tb_per_u" name="tb_per_u" placeholder="tb_per_u" value="{{ old('tb_per_u') ?? $item->tb_per_u }}">
    </div>
    <div class="form-group">
        <label for="zs_tb_per_u">ZS TB/U</label>
        <input type="text" class="form-control" id="zs_tb_per_u" name="zs_tb_per_u" placeholder="zs_tb_per_u" value="{{ old('zs_tb_per_u') ?? $item->zs_tb_per_u }}">
    </div>
    <div class="form-group">
        <label for="bb_per_tb">BB/TB</label>
        <input type="text" class="form-control" id="bb_per_tb" name="bb_per_tb" placeholder="bb_per_tb" value="{{ old('bb_per_tb') ?? $item->bb_per_tb }}">
    </div>
    <div class="form-group">
        <label for="zs_bb_per_tb">ZS BB/TB</label>
        <input type="text" class="form-control" id="zs_bb_per_tb" name="zs_bb_per_tb" placeholder="zs_bb_per_tb" value="{{ old('zs_bb_per_tb') ?? $item->zs_bb_per_tb }}">
    </div>
    <div class="form-group">
        <label for="naik_berat_badan">Naik Berat Badan</label>
        <input type="text" class="form-control" id="naik_berat_badan" name="naik_berat_badan" placeholder="naik_berat_badan" value="{{ old('naik_berat_badan') ?? $item->naik_berat_badan }}">
    </div>
    <div class="form-group">
        <label for="pmt_diterima">PMT Diterima</label>
        <input type="text" class="form-control" id="pmt_diterima" name="pmt_diterima" placeholder="pmt_diterima" value="{{ old('pmt_diterima') ?? $item->pmt_diterima }}">
    </div>
    <div class="form-group">
        <label for="jml_vit_a">Jml Vit. A</label>
        <input type="text" class="form-control" id="jml_vit_a" name="jml_vit_a" placeholder="jml_vit_a" value="{{ old('jml_vit_a') ?? $item->jml_vit_a }}">
    </div>
    <div class="form-group">
        <label for="kpsp">KPSP</label>
        <input type="text" class="form-control" id="kpsp" name="kpsp" placeholder="kpsp" value="{{ old('kpsp') ?? $item->kpsp }}">
    </div>
    <div class="form-group">
        <label for="kia">KIA</label>
        <input type="text" class="form-control" id="kia" name="kia" placeholder="kia" value="{{ old('kia') ?? $item->kia }}">
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>