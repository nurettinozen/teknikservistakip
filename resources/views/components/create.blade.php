@extends('adminlte::page')

@section('title', 'Yeni Yedek Parça Ekle')

@section('content_header')
    <h1>Yeni Yedek Parça Ekle</h1>
@stop

@section('content')
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Yeni Yedek Parça Ekle</h3>
        </div>
        <div class="box-body pad">

            {!! Form::open(['route' => 'components.store', 'method' => 'POST']) !!}


            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Marka Seçiniz</label>
                        {!! Form::select('brand_id', $brands->pluck('brand_name', 'id'), old('brand_id'), ['class' => 'form-control select2', 'id' => 'brand_id']) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="model_id">Model Seçiniz</label>
                        <select id="model_id" name="model_id" class="form-control select2">

                        </select>
                        {{ csrf_field() }}
                    </div>
                </div>
                


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="component_name">Parça Adı (Örnek : ASUS K55-VD Ekran)</label>
                        <input type="text" class="form-control" name="component_name" id="component_name">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stock">Stok Adeti</label>
                        <input type="number" class="form-control" name="stock" id="stock">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="get_price">Geliş Fiyatı</label>
                        <input type="number" class="form-control" name="get_price" id="get_price">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sell_price">Satış Fiyatı</label>
                        <input type="number" class="form-control" name="sell_price" id="sell_price">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger btn-block bold btn-lg"><i class="fa fa-send"></i> Yeni Yedek Parçayı Ekle </button>
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
        $(document).ready(function (e) {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
            $('.select2').select2({
                placeholder: 'Lütfen Seçim Yapınız...'
            });
            $("#brand_id").append('<option selected disabled>Lütfen Seçim Yapınız...</option>');
        });
    </script>

    <script type="text/javascript">
        $('#brand_id').change(function(){
            var brand_id = $(this).val();
            if(brand_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('getModels')}}?brand_id="+brand_id,
                    success:function(res){
                        if(res){
                            $("#model_id").empty();
                            $("#model_id").append('<option disabled>Lütfen Seçim Yapınız...</option>');
                            $.each(res,function(key,value){
                                $("#model_id").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#model_id").empty();
                        }
                    }
                });
            }else{
                $("#model_id").empty();
            }
        });
    </script>



    @include('particle.alert')
@endsection
