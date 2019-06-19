@extends('adminlte::page')

@section('title', 'Yeni Marka Ekle')

@section('content_header')
    <h1>Yeni Marka Ekle</h1>
@stop

@section('content')
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Yeni Marka Ekle</h3>
        </div>
        <div class="box-body pad">

            {!! Form::open(['route' => ['brands.update',$brand->id],'method' => 'PUT', 'files' => true ]) !!}


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="brand_name">Marka Başlığı (Marka Adı Örn: ASUS)</label>
                        <input type="text" class="form-control" name="brand_name" id="brand_name" value="{{ $brand->brand_name }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger btn-block bold btn-lg"><i class="fa fa-upload"></i>  Markayı Güncelle</button>
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
