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
                url: '/admin/tps/get_list_tps/' + val,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_tps]").html(response);
                }
            });

            $.ajax({
                url: '/admin/kelurahan/get_list_kelurahan/' + val,
                type: "GET",
                dataType: "text",
                success: function(response) {
                    $("[name=id_kelurahan]").html(response);
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
                        <h3 class="card-title">Create Pemilih</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('pemilih.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.pemilih.partials.form-control')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection