@extends('adminlte::page')

@section('title', 'Servis Formu Girişi')

@section('content_header')
    <h1>Servis Formu Girişi</h1>
@stop
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

{{ $barcode = Session::get('barcode') }}
@if($barcode){
<script>
    toastr.success("{{$barcode}}", "", window.errorOpts);
</script>
@endif



@section('content')
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Yeni Servis Formu Ekle</h3>
        </div>
        <div class="box-body pad">

            {!! Form::open(['route' => 'devices.store', 'method' => 'POST']) !!}


            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                        <p>
                            <small>Müşteri Bilgileri</small>
                        </p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>
                            <small>Cihaz Bilgileri</small>
                        </p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>
                            <small>Form Detayları</small>
                        </p>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p>
                            <small>Teslim Bilgileri</small>
                        </p>
                    </div>
                </div>
            </div>


                <div class="panel panel-danger setup-content" id="step-1">
                    <div class="panel-heading">
                        <h3 class="panel-title">Müşteri Bilgileri</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="customer_id">Müşteriyi Seçiniz (Arama Yapılabilir Alan)</label>
                            <select class="form-control select2" name="customer_id" id="customer_id">
                                @foreach($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}">{{ $customer->name }} {{ $customer->surname }} {{ $customer->company_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button class="btn btn-danger nextBtn pull-right" type="button"><i class="fa fa-angle-double-right"></i> Sonraki</button>
                    </div>
                </div>

                <div class="panel panel-danger setup-content" id="step-2">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cihaz Bilgileri</h3>
                    </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="guarantee">Garanti Durumu</label>
                            <select id="guarantee" name="guarantee" class="form-control select2">
                                <option value="1">Garantisi Var</option>
                                <option value="0">Garantisi Yok (Ücretli Onarım)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="guarantee_start">Garanti Başlangıç Tarihi</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" data-provide="datepicker">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="guarantee_finish">Garanti Bitiş Tarihi</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" data-provide="datepicker">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="category">Marka Seçiniz</label>
                            {!! Form::select('brand_id', $brands->pluck('brand_name', 'id'), old('brand_id'), ['class' => 'form-control select2', 'id' => 'brand_id']) !!}
                        </div>


                        <div class="form-group">
                            <label for="model_id">Model Seçiniz</label>
                            <select id="model_id" name="model_id" class="form-control select2">

                            </select>
                            {{ csrf_field() }}
                        </div>

                        <button class="btn btn-danger nextBtn pull-right" type="button"><i class="fa fa-angle-double-right"></i> Sonraki</button>
                    </div>
                </div>

                <div class="panel panel-danger setup-content" id="step-3">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Detayları</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="customer_request">Müşteri İstekleri</label>
                            <textarea name="customer_request" id="customer_request" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="pre_detection">Ön Tespitler</label>
                            <textarea name="pre_detection" id="pre_detection" class="form-control"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="repair_description">Tamir Açıklaması</label>
                            <textarea name="repair_description" id="repair_description" class="form-control"></textarea>
                        </div>



                        <div class="form-group">
                            <label for="serial_number">Seri Numarası</label>
                            <input type="text" class="form-control" name="serial_number" id="serial_number">
                        </div>


                        <button class="btn btn-danger nextBtn pull-right" type="button"><i class="fa fa-angle-double-right"></i> Sonraki</button>
                    </div>
                </div>

                <div class="panel panel-danger setup-content" id="step-4">
                    <div class="panel-heading">
                        <h3 class="panel-title">Teslim Bilgileri</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="delivered_person">Teslim Eden</label>
                            <input type="text" class="form-control" name="delivered_person" id="delivered_person">
                        </div>



                        <button type="submit" class="btn btn-danger btn-block bold btn-lg"><i class="fa fa-address-book"></i>
                            Servis Formunu Oluştur
                        </button>
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
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                startDate: '-3d'
            });
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

            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
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
        $(document).ready(function () {
            $("#brand_id").append('<option selected disabled>Lütfen Seçim Yapınız...</option>');
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-success').addClass('btn-default');
                    $item.addClass('btn-success');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-success').trigger('click');
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
