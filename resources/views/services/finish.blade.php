@extends('adminlte::page')

@section('title', 'Servis Durumundaki Cihazlar (Tamirdeki Cihazlar)')

@section('content_header')
    <h1>Tamir İşlemi Bitmiş Cihazlar</h1>
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
        <div class="col-md-12">

            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Tamir İşlemi Bitmiş (Teslim Edilmiş) Cihazlar</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <table class="table table-bordered table-hover table-responsive" id="">
                        <thead>
                        <tr>
                            <th>#Barcode</th>
                            <th>Müşteri Adı</th>
                            <th>Marka-Model</th>
                            <th>İletişim</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody id="post-list" name="post-list">
                        @foreach ($services as $key => $device)

                            <tr id="post{{$key}}" class="">
                                <td>{{ $device->barcode }}</td>
                                <td>{{ $device->name }} {{ $device->surname }}</td>
                                <td>{{ $device->brand_name }}-{{ $device->model_name }}</td>
                                <td>{{ $device->gsm }}</td>
                                <td>
                                    @if($device->service_status == 255)
                                        <span class="badge badge-info bg-green-gradient">Teslim edildi</span>
                                    @endif


                                </td>
                                <td style="width:10%">
                                    <button type="button" class="btn btn-warning bold uppercase delete_button"
                                            data-toggle="modal" data-target="#FormModal"
                                            onclick="showForm({{$device->barcode}})">
                                        <i class='fa fa-search'></i> DETAYLAR
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
    <div id="DeleteModal" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">İŞLEM ONAYI</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p class="text-center">Silme işlemi yapıyorsunuz. Bunu yapmak istediğinize eminmisiniz? ?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                    onclick="formSubmit()">Evet, Silebilirsin
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="StartService" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="StartServiceForm" method="POST">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">SERVİS İŞLEMİ BAŞLATMA ONAYI</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p class="text-center">Servis İşlemini Başlatıyorsunuz. Cihazın durumu değiştirilip <b>SIRA
                                BEKLİYOR</b> durumuna getirilecek, onaylıyormusunuz?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-success" data-dismiss="modal">İptal</button>
                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                    onclick="startService()">Evet, Onaylıyorum
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="FormModal" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="ShowBarcode" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Form Detayları Alanı</h4>
                    </div>
                    <div id="form_print">

                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <p class="text-center">
                            <div id="barcode" class="text-left">

                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/adminlte/plugins/jQueryPrint/jQuery.print.js') }}"></script>

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
