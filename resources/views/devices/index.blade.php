@extends('adminlte::page')

@section('title', 'Kayıtlı Müşterileri Listele')

@section('content_header')
    <h1>Aktif Servis Formları</h1>
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
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Aktif Servis Formları</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <table class="table table-bordered table-hover" id="">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Müşteri Adı</th>
                            <th>Marka-Model</th>
                            <th>Model Adı</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody id="post-list" name="post-list">
                        @foreach ($devices as $key => $device)
                            <tr id="post{{$key}}" class="">
                                <td>{{ $device->id }}</td>
                                <td>{{ $device->customer_id }}</td>
                                <td>{{ $device->brand_id }}-{{ $device->model_id }}</td>
                                <td>{{ $device->model_id }}</td>
                                <td>

                                    {{ $device->status }}

                                </td>
                                <td style="width:20%">
                                    <a href="{{ route('devices.edit', $device->id) }}"
                                       class="btn btn-primary bold uppercase"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#DeleteModal"
                                            onclick="deleteData({{$device->id}})">
                                        <i class='fa fa-trash'></i> SİL
                                    </button>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#BarcodeModal"
                                            onclick="showBarcode({{$device->id}})">
                                        <i class='fa fa-print'></i> Barkod Yazdır
                                    </button>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#FormModal"
                                            onclick="showForm({{$device->id}})">
                                        <i class='fa fa-print'></i> Form Yazdır
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $devices->links() }}
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


    <div id="BarcodeModal" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="ShowBarcode" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Barkod Alanı</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}
                        <p class="text-center">
                        <div id="barcode" class="text-center">
                            test
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                    onclick="BarcodePrint()"><i class="fa fa-print"></i> Barkodu Yazdır
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
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}
                        <p class="text-center">
                        <div id="barcode" class="text-center">
                            test
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                    onclick="FormPrint()"><i class="fa fa-print"></i> Formu Yazdır
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

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

        function showBarcode(id) {
            var id = id;
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('showBarcode')}}?id=" + id,
                    success: function (res) {
                        if (res) {
                            $("#barcode").empty();
                            $("#barcode").html('<img src="http://barcodes4.me/barcode/c128b/' + res['barcode'] + '.png?IsTextDrawn=1&TextSize=12" />');
                        } else {
                            $("#barcode").empty();
                        }
                    }
                });
            }
        }
    </script>
    @include('particle.alert')
@endsection
