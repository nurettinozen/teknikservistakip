@extends('adminlte::page')

@section('title', 'Yeni Müşteri Ekle')

@section('content_header')
    <h1>Yeni Müşteri Ekle</h1>
@stop

@section('content')
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Yeni Müşteri Ekle</h3>
        </div>
        <div class="box-body pad">

            {!! Form::open(['route' => 'customers.store', 'method' => 'POST']) !!}


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="type">Müşteri Türü</label>
                        <select class="form-control select2" name="type" id="type">
                            <option value="0">Bireysel Üyelik</option>
                            <option value="1">Kurumsal Üyelik</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Müşteri Adı</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="surname">Müşteri Soyadı</label>
                        <input type="text" class="form-control" name="surname" id="surname">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gsm">Müşteri GSM Telefon</label>
                        <input type="text" class="form-control" name="gsm" id="gsm">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">Müşteri Sabit Telefon</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="identity_number">Müşteri TC Kimlik No</label>
                        <input type="text" class="form-control" name="identity_number" id="identity_number">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Müşteri Adresi</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                </div>
            </div>


            <div id="kurumsal" class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tax_authority">Vergi Dairesi</label>
                        <input type="text" class="form-control" name="tax_authority" id="tax_authority">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tax_number">Vergi Kimlik NO</label>
                        <input type="text" class="form-control" name="tax_number" id="tax_number">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="company_name">Firma Ünvanı</label>
                        <input type="text" class="form-control" name="company_name" id="company_name">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger btn-block bold btn-lg"><i class="fa fa-send"></i> Yeni Müşteriyi Kaydet </button>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>


@stop


@section('js')
    <script src="{{asset('assets/admin/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>

    <script>
        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }
    </script>


    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
    <script>
        function preview_images() {
            document.getElementById("image_preview").innerHTML = "";
            var total_file = document.getElementById("images").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
            }
        }
    </script>

    <script>
        $(function () {
            $('#myTable').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': false,
                'info': true
            });
        });
    </script>
    <script>
        $('#kurumsal').hide();

        $('#type').change(function () {
            var value = $(this).val();
            if (value == '1') {
                $('#kurumsal').show();
            } else {
                $('#kurumsal').hide();
            }
        });
    </script>
    <script>
        $(document).ready(function (e) {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
        });
    </script>
    @include('particle.alert')
@endsection
