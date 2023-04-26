@extends('layouts.backend.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Detail User</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <p>
                            <label>Name</label><br />
                            {{ $item->name ?? null }}
                        </p>
                        <p>
                            <label>Telpon</label><br />
                            {{ $item->name ?? null }}
                        </p>
                        <p>
                            <label>Alamat</label><br />
                            {{ $item->alamat ?? null }}
                        </p>
                        @if($item->jenis_pelanggan && $item->jenis_pelanggan->count() > 0)
                        <p>
                            <label>Jenis Pelanggan</label><br />
                            @foreach($item->jenis_pelanggan as $jenis_pelanggan)
                            {{ $jenis_pelanggan->nama ?? null }}&nbsp;
                            @endforeach
                        </p>
                        @endif

                        @if($item->spk && $item->spk->count() > 0)
                        <p>
                            <label>SPK</label><br />
                        <table class="table">
                            <tr>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                            @foreach($item->spk as $spk)
                            <tr>
                                <td>{{ $spk->nomor ?? null }}</td>
                                <td>{{ $spk->tanggal ?? null }}</td>
                                <td>
                                    @if($spk->status == '0')
                                    Belum dicetak/disetujui
                                    @else
                                    Telah dicetak/disetujui
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        </p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="{{ route('user.index') }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection