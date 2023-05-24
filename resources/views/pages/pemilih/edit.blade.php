@extends('layouts.backend.app')
@push('addon-script')
<!-- bs-custom-file-input -->
<script src="/template/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();

        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        var id_propinsi = '{{ $item->kelurahan->kecamatan->kabupaten->propinsi->id ?? null }}';
        $('[name=id_propinsi]').val(id_propinsi).change();
        var id_kabupaten = '{{ $item->kelurahan->kecamatan->kabupaten->id ?? null }}';
        var id_kecamatan = '{{ $item->kelurahan->id_kecamatan ?? null }}';
        var id_kelurahan = '{{ $item->id_kelurahan ?? null }}';
        var id_tps = '{{ $item->id_tps ?? null }}';

        if (id_propinsi != null) {
            $.ajax({
                url: '/admin/kabupaten/get_list_kabupaten/' + id_propinsi,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kabupaten]").html(response);
                    $("[name=id_kabupaten]").val(id_kabupaten);
                }
            });
        }

        if (id_kabupaten != null) {
            $.ajax({
                url: '/admin/kecamatan/get_list_kecamatan/' + id_kabupaten,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kecamatan]").html(response);
                    $("[name=id_kecamatan]").val(id_kecamatan);
                }
            });
        }

        if (id_kecamatan != null) {
            $.ajax({
                url: '/admin/tps/get_list_tps/' + id_kecamatan,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_tps]").html(response);
                    $("[name=id_tps]").val(id_tps);
                }
            });

            $.ajax({
                url: '/admin/kelurahan/get_list_kelurahan/' + id_kecamatan,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kelurahan]").html(response);
                    $("[name=id_kelurahan]").val(id_kelurahan);
                }
            });
        }

        if (id_kelurahan != null) {
            $.ajax({
                url: '/admin/tps/get_list_tps/' + id_kelurahan,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_tps]").html(response);
                    $("[name=id_tps]").val(id_tps);
                }
            });
        }

        $(document).on('change', '[name=id_propinsi]', function() {
            var val = $(this).val();

            $.ajax({
                url: '/admin/kabupaten/get_list_kabupaten/' + val,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kabupaten]").html(response);
                }
            });

        });

        $(document).on('change', '[name=id_kabupaten]', function() {
            var val = $(this).val();

            $.ajax({
                url: '/admin/kecamatan/get_list_kecamatan/' + val,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kecamatan]").html(response);
                }
            });
        });

        $(document).on('change', '[name=id_kecamatan]', function() {
            var val = $(this).val();

            $.ajax({
                url: '/admin/kelurahan/get_list_kelurahan/' + val,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kelurahan]").html(response);
                }
            });
        });

        $(document).on('change', '[name=id_kelurahan]', function() {
            var val = $(this).val();

            $.ajax({
                url: '/admin/tps/get_list_tps/' + val,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_tps]").html(response);
                }
            });
        });
    });
</script>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Pemilih</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('pemilih.update', $item->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @include('pages.pemilih.partials.form-control', ['submit' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection