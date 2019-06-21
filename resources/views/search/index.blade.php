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
                                <label for="serial_number">Cihaz Seri Numarası</label>
                                <input type="text" class="form-control" name="serial_number" id="serial_number">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @if(count($errors))
        @foreach($errors->all() as $message)
            <script>
                toastr.error("{{$message}}", "", window.successOpts);
            </script>
        @endforeach
    @endif

    {{ $success = Session::get('success') }}
    @if($success){
    <script>
        swal("{{$success}}" ,  "" );
    </script>
    @endif


@endsection
