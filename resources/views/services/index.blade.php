@extends('adminlte::page')

@section('title', 'Servis Durumundaki Cihazlar (Tamirdeki Cihazlar)')

@section('content_header')
    <h1>Servis Durumundaki Cihazlar (Tamirdeki Cihazlar)</h1>
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
            <div class="alert bg-blue-gradient">
                Aşağıdaki formda yalnızca kabul edilmiş cihazlar listelenir, Servis (Müdahale) durumuna geçmiş cihazlar
                <a href="#">Servis Durumundaki Cihazlar</a> listesinden görüntülenebilir.
            </div>
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Servis Durumundaki Cihazlar (Tamirdeki
                        Cihazlar)</h3>
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
                                    @if($device->service_status == 0)
                                        <span class="badge badge-info bg-gray-gradient">Cihaz Teslim Alındı</span>
                                    @elseif($device->service_status == 1)
                                        <span class="badge badge-info bg-aqua-gradient">Sıra Bekliyor</span>
                                    @elseif($device->service_status == 2)
                                        <span class="badge badge-info bg-orange-gradient">Onarım İşleminde</span>
                                    @elseif($device->service_status == 3)
                                        <span class="badge badge-info bg-teal-gradient">Merkeze Gönderildi</span>
                                    @elseif($device->service_status == 4)
                                        <span class="badge badge-info bg-black-gradient">Parça Bekliyor</span>
                                    @elseif($device->service_status == 5)
                                        <span class="badge badge-info bg-fuchsia-gradient">Onay Bekliyor</span>
                                    @elseif($device->service_status == 6)
                                        <span class="badge badge-info bg-blue-gradient">Cihazınız Hazır</span>
                                    @elseif($device->service_status == 7)
                                        <span class="badge badge-info bg-light-blue-gradient">Kargolandı</span>
                                    @elseif($device->service_status == 255)
                                        <span class="badge badge-info bg-green-gradient">Teslim edildi</span>
                                    @endif


                                </td>
                                <td style="width:38%">
                                <!--a href="{{ route('devices.edit', $device->id) }}"
                                       class="btn btn-primary bold uppercase"><i class="fa fa-edit"></i> Düzenle</a-->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">İŞLEMLER</button>
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="btn btn-secondary" href="{{ route('services.edit', $device->barcode) }}">Parça Detayları
                                                    Ekle</a></li>
                                            <li class="divider"></li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('send.center', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button style="width: 100%" class="btn btn-bitbucket" type="submit" class="bold uppercase">Merkeze
                                                        Gönderildi
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('repair.start', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" style="width: 100%" class="btn btn-bitbucket">Onarım
                                                        İşleminde
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('components.waiting', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" style="width: 100%" class="btn btn-bitbucket">Parça
                                                        Bekliyor
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('confirm.waiting', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" style="width: 100%" class="btn btn-bitbucket">Onay
                                                        Bekliyor
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('device.ready', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" style="width: 100%" class="btn btn-bitbucket">
                                                        Cihazınız Hazır
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('device.shipping', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" style="width: 100%" class="btn btn-bitbucket">
                                                        Kargolandı
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class="btn-group"
                                                      style="width: 100%"
                                                      action="{{ route('device.delivered', ['id' => $device->barcode]) }}"
                                                      method="post">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit"
                                                            style="width: 100%"
                                                            class="btn btn-bitbucket btn-block">Teslim
                                                        Edildi
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#DeleteModal"
                                            onclick="deleteData({{$device->id}})">
                                        <i class='fa fa-trash'></i> İptal
                                    </button>
                                    <button type="button" class="btn btn-info bold uppercase delete_button"
                                            data-toggle="modal" data-target="#BarcodeModal"
                                            onclick="showBarcode({{$device->barcode}})">
                                        <i class='fa fa-print'></i> Barkod Yazdır
                                    </button>
                                    <button type="button" class="btn btn-warning bold uppercase delete_button"
                                            data-toggle="modal" data-target="#FormModal"
                                            onclick="showForm({{$device->barcode}})">
                                        <i class='fa fa-print'></i> Form Yazdır
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
                        <div class="">
                            <style>
                                #barcode {
                                    float: left;
                                    margin-left: 7px;
                                    margin-top:7px;
                                }

                                #barcode_repeat {
                                    float: left;
                                    margin-left:7px;
                                    margin-top:8px;
                                }

                                #barcode_print {
                                    min-height: 90px;
                                    max-width: 320px;
                                }

                            </style>
                            <div id="barcode_print">
                                <div id="barcode"></div>
                                <!--div id="barcode_repeat"></div-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" name="" class="btn btn-danger barcodeprint" data-dismiss="modal"
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
                    <div id="form_print">

                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <p class="text-center">
                            <div id="barcode" class="text-left">
                                <style id="servis Formu_27903_Styles">
                                    <!--
                                    table {
                                        mso-displayed-decimal-separator: "\,";
                                        mso-displayed-thousand-separator: "\.";
                                    }

                                    @page {
                                        margin: .75in .25in .75in .25in;
                                        mso-header-margin: .3in;
                                        mso-footer-margin: .3in;
                                    }

                                    tr {
                                        mso-height-source: auto;
                                    }

                                    col {
                                        mso-width-source: auto;
                                    }

                                    br {
                                        mso-data-placement: same-cell;
                                    }

                                    .style0 {
                                        mso-number-format: General;
                                        text-align: general;
                                        vertical-align: bottom;
                                        white-space: nowrap;
                                        mso-rotate: 0;
                                        mso-background-source: auto;
                                        mso-pattern: auto;
                                        color: black;
                                        font-size: 11.0pt;
                                        font-weight: 400;
                                        font-style: normal;
                                        text-decoration: none;
                                        font-family: Calibri, sans-serif;
                                        mso-font-charset: 162;
                                        border: none;
                                        mso-protection: locked visible;
                                        mso-style-name: Normal;
                                        mso-style-id: 0;
                                    }

                                    td {
                                        mso-style-parent: style0;
                                        padding-top: 1px;
                                        padding-right: 1px;
                                        padding-left: 1px;
                                        mso-ignore: padding;
                                        color: black;
                                        font-size: 11.0pt;
                                        font-weight: 400;
                                        font-style: normal;
                                        text-decoration: none;
                                        font-family: Calibri, sans-serif;
                                        mso-font-charset: 162;
                                        mso-number-format: General;
                                        text-align: general;
                                        vertical-align: bottom;
                                        border: none;
                                        mso-background-source: auto;
                                        mso-pattern: auto;
                                        mso-protection: locked visible;
                                        white-space: nowrap;
                                        mso-rotate: 0;
                                    }

                                    .xl63 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        vertical-align: middle;
                                    }

                                    .xl64 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        vertical-align: top;
                                    }

                                    .xl65 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        vertical-align: top;
                                        white-space: normal;
                                        mso-text-control: shrinktofit;
                                    }

                                    .xl66 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        vertical-align: middle;
                                        white-space: normal;
                                    }

                                    .xl67 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                    }

                                    .xl68 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        vertical-align: top;
                                        white-space: normal;
                                    }

                                    .xl69 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: right;
                                        vertical-align: middle;
                                    }

                                    .xl70 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: left;
                                        vertical-align: top;
                                    }

                                    .xl71 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: left;
                                    }

                                    .xl72 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: center;
                                        vertical-align: top;
                                        white-space: normal;
                                    }

                                    .xl73 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: left;
                                        vertical-align: middle;
                                        white-space: normal;
                                        mso-text-control: shrinktofit;
                                    }

                                    .xl74 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: left;
                                        vertical-align: top;
                                        white-space: normal;
                                    }

                                    .xl75 {
                                        mso-style-parent: style0;
                                        font-weight: 700;
                                        text-align: left;
                                        vertical-align: top;
                                        background: white;
                                        mso-pattern: black none;
                                    }

                                    -->
                                </style>
                                <div id="servis Formu_27903" align=center x:publishsource="Excel">

                                    <table border=0 cellpadding=0 cellspacing=0 width=790 style='border-collapse:
 collapse;table-layout:fixed;width:585pt'>
                                        <col width=23 span=30 style='mso-width-source:userset;mso-width-alt:725;
 width:17pt'>
                                        <col width=25 style='mso-width-source:userset;mso-width-alt:810;width:19pt'>
                                        <col width=24 style='mso-width-source:userset;mso-width-alt:768;width:18pt'>
                                        <col width=23 style='mso-width-source:userset;mso-width-alt:725;width:17pt'>
                                        <col width=28 style='mso-width-source:userset;mso-width-alt:896;width:21pt'>
                                        <col width=23 span=5 style='mso-width-source:userset;mso-width-alt:725;
 width:17pt'>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl67 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td class=xl67 width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td class=xl63 align=right width=25 style='width:19pt'><span
                                                    id="date"></span></td>
                                            <td class=xl69 width=24 style='width:18pt'></td>
                                            <td colspan=2 class=xl69 width=51 style='width:38pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl67 style='height:15.75pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl67 style='height:15.75pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl64></td>
                                            <td colspan=16 class=xl75><span id="name_surname"></span></td>
                                            <td class=xl67></td>
                                            <td colspan=11 class=xl71><span id="gsm"></span></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl67 style='height:15.75pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl66 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td colspan=29 rowspan=4 class=xl72 width=670 style='width:496pt'>
                                                <span id="address"></span>
                                            </td>
                                            <td class=xl66 width=28 style='width:21pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl66 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=28 style='width:21pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl66 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=28 style='width:21pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl66 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=23 style='width:17pt'></td>
                                            <td class=xl66 width=28 style='width:21pt'></td>
                                        </tr>
                                        <tr height=23 style='mso-height-source:userset;height:17.25pt'>
                                            <td height=23 class=xl67 style='height:17.25pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td colspan=29 style='mso-ignore:colspan'></td>
                                            <td></td>
                                        </tr>
                                        <tr height=24 style='mso-height-source:userset;height:18.75pt'>
                                            <td height=24 class=xl67 style='height:18.75pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl64></td>
                                            <td colspan=7 class=xl70><span id="brand"></span></td>
                                            <td class=xl64></td>
                                            <td colspan=8 class=xl70><span id="model"></span></td>
                                            <td class=xl64></td>
                                            <td colspan=11 class=xl70><span id="serial_number"></span></td>
                                            <td></td>
                                        </tr>
                                        <tr height=8 style='mso-height-source:userset;height:6.75pt'>
                                            <td height=8 class=xl67 style='height:6.75pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl64></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl64></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td class=xl70></td>
                                            <td></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl67 style='height:15.75pt'></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td class=xl67></td>
                                            <td colspan=29 rowspan=3 class=xl74 width=675 style='width:500pt'>
                                                <span id="pre_detection"></span>
                                            </td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                        </tr>
                                        <tr height=11 style='mso-height-source:userset;height:8.25pt'>
                                            <td height=11 class=xl65 width=23 style='height:8.25pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=25 style='width:19pt'></td>
                                            <td class=xl68 width=24 style='width:18pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td colspan=28 rowspan=2 class=xl73 width=652 style='width:483pt'>


                                            </td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl68 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=25 style='width:19pt'></td>
                                            <td class=xl65 width=24 style='width:18pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=28 style='width:21pt'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td colspan=29 style='mso-ignore:colspan'></td>
                                            <td></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td colspan=30 style='mso-ignore:colspan'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td colspan=18 style='mso-ignore:colspan'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td colspan=18 style='mso-ignore:colspan'></td>
                                        </tr>
                                        <tr height=20 style='mso-height-source:userset;height:15.75pt'>
                                            <td height=20 class=xl65 width=23
                                                style='height:15.75pt;width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td class=xl65 width=23 style='width:17pt'></td>
                                            <td colspan=18 style='mso-ignore:colspan'></td>
                                        </tr>
                                        <![if supportMisalignedColumns]>
                                        <tr height=0 style='display:none'>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=25 style='width:19pt'></td>
                                            <td width=24 style='width:18pt'></td>
                                            <td width=23 style='width:17pt'></td>
                                            <td width=28 style='width:21pt'></td>
                                        </tr>
                                        <![endif]>
                                    </table>

                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" name="" class="btn btn-danger" data-dismiss="modal"
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
