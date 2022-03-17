@extends ('backend.layouts.app', ['activePage' => 'permission-management', 'titlePage' => 'Zarządzanie Uprawnieniami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card box-info">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Zarządzanie Uprawnieniami</h4>

                        <div class="card-tools">
                            @include('backend.access.includes.partials.permission-header-buttons')
                        </div>
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="permissions-table" class="table table-condensed table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Uprawnienie</th>
                                        <th>Nazwa Wyświetlana</th>
                                        <th>Kolejność</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            {!! Form::text('permission', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Uprawnienie']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                                        </th>
                                        <th>
                                            {!! Form::text('display_name', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Nazwa']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                                        </th>
                                        <th>
                                            {!! Form::text('sort', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'Kolejność']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fa fas-times"></i></a>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!--table-responsive-->
                    </div><!-- /.box-body -->
                </div><!--box-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-success d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Historia</h4>
                        <div class="card-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div> -->
                    <div class="card-body">
                        {{-- {!! history()->renderType('Permission') !!} --}}
                    </div><!-- /.box-body -->
                </div><!--box box-info-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    {{-- For DataTables --}}

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var dataTable = $('#permissions-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.access.permission.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: '{{config('access.permissions_table')}}.name'},
                    {data: 'display_name', name: '{{config('access.permissions_table')}}.display_name', sortable: false},
                    {data: 'sort', name: '{{config('access.permissions_table')}}.sort'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection