@extends('adminlte::page')

@section('title', 'Servis Durumundaki Cihazlar (Tamirdeki Cihazlar)')

@section('content_header')
    <h1>Servis Sorgulama Ekranı</h1>
@stop
@section('style')
    <style>
        @media print {
            table td:last-child {
                display: none
            }

            table th:last-child {
                display: none
            }
        }

        .select2-selection, .select2-results {
            font-weight: bold !important;
        }
    </style>
@endsection
@section('content')


    <div class="row">
        <div class="col-md-6">

            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-barcode"></i> Barkod Numarası İle Sorgula</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    {!! Form::open(['route' => 'search.barcode', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="barcode">Barkod Numarası</label>
                                <input type="text" class="form-control" name="barcode" id="barcode">
                            </div>
                            <button type="submit" class="btn btn-success btn-block bold"><i class="fa fa-search"></i> Sorgula </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-sort-numeric-asc"></i> Cihaz Seri Numarası İle Sorgula</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    {!! Form::open(['route' => 'search.serial', 'method' => 'POST']) !!}
                    <div class="row">


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="component_name">Cihaz Seri Numarası</label>
                                <input type="text" class="form-control" name="component_name" id="component_name">
                            </div>
                            <button type="submit" class="btn btn-success btn-block bold"><i class="fa fa-search"></i> Sorgula </button>
                        </div>


                    </div>



                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script src="{{ asset('vendor/adminlte/plugins/jQueryPrint/jQuery.print.js') }}"></script>
    <script>
        function BarcodePrint() {
            $("#barcode_print").print({
                globalStyles: true,
                mediaPrint: true,
                stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                iframe: true,
                noPrintSelector: ".avoid-this",
                manuallyCopyFormValues: true,
                deferred: $.Deferred(),
                timeout: 250,
                title: null,
                doctype: '<!doctype html>'
            });
        }

        function FormPrint() {
            $("#form_print").print({
                globalStyles: false,
                mediaPrint: false,
                stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                iframe: false,
                noPrintSelector: ".avoid-this",
                manuallyCopyFormValues: true,
                deferred: $.Deferred(),
                timeout: 250,
                title: null,
                doctype: '<!doctype html>'
            });
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
    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route("devices.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        function serviceStart(id) {
            var id = id;
            var url = '{{ route("service.start", ":id") }}';
            url = url.replace(':id', id);
            $("#StartServiceForm").attr('action', url);
        }

        function startService() {
            $("#StartServiceForm").submit();
        }

        function showBarcode(id) {
            var id = id;
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('showBarcode')}}?id=" + id,
                    success: function (res) {
                        if (res) {
                            $("#barcode").empty();
                            $("#barcode").html('<img width="140" src="http://barcodes4.me/barcode/i2of5/' + res['barcode'] + '.png?IsTextDrawn=1&TextSize=12" />');
                            $("#barcode_repeat").html('<img width="140" src="http://barcodes4.me/barcode/i2of5/' + res['barcode'] + '.png?IsTextDrawn=1&TextSize=12" />');
                        } else {
                            $("#barcode").empty();
                        }
                    }
                });
            }
        }


        function showForm(id) {
            var id = id;
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('showForm')}}?id=" + id,
                    success: function (res) {
                        if (res) {
                            $("#customer_id").html(res['form']['customer_id']);
                            $("#barcode2").html(res['form']['barcode']);
                            $("#name_surname").html(res['customer']['name'] + ' ' + res['customer']['surname']);
                            $("#gsm").html(res['customer']['gsm']);
                            $("#address").html(res['customer']['address']);
                            $("#brand").html(res['brand']['brand_name']);
                            $("#model").html(res['model']['model_name']);
                            $("#serial_number").html(res['form']['serial_number']);
                            $("#pre_detection").html(res['form']['pre_detection']);
                            $("#customer_request").html(res['form']['customer_request']);
                            $("#delivered_person").html(res['form']['delivered_person']);
                            $("#date").html(res['form']['created_at']);
                        } else {
                            $("#customer_id").empty();
                        }
                    }
                });
            }
        }
    </script>
    @include('particle.alert')
@endsection
