@extends('adminlte::page')

@section('title', 'Kayıtlı Modelleri Listele')

@section('content_header')
    <h1>Sistemde Kayıtlı Modeller</h1>
@stop
@section('style')
    <style>
        @media print {
            table td:last-child {display:none}
            table th:last-child {display:none}
        }
        .select2-selection,.select2-results{
            font-weight: bold !important;
        }
    </style>
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Sistemde Kayıtlı Modeller</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <table class="table table-bordered table-hover" id="myTable">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Marka Adı</th>
                            <th>Model Adı</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody id="post-list" name="post-list">

                        <?php $i = 0 ?>
                        @foreach ($modellings as $key => $modelling)

                            <tr id="post{{$key}}" class="">
                                <td>{{ $modelling->id }}</td>
                                <td>{{ $modelling->brand_id}}</td>
                                <td>{{ $modelling->model_name }}</td>
                                <td style="width:15%">
                                    <a href="{{ route('brands.edit', $modelling->id) }}" class="btn btn-primary bold uppercase"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#DeleteModal"
                                            onclick="deleteData({{$modelling->id}})">
                                        <i class='fa fa-trash'></i> SİL
                                    </button>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
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
                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Evet, Silebilirsin</button>
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
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : false,
                'info'        : true
            });
        });
    </script>
    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("modellings.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
    @include('particle.alert')
@endsection
