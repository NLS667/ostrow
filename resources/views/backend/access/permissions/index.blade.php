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
                            <table id="permissions-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Uprawnienie</th>
                                        <th>Nazwa Wyświetlana</th>
                                        <th>Kolejność</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Uprawnienie</th>
                                        <th>Nazwa Wyświetlana</th>
                                        <th>Kolejność</th>
                                        <th class="text-right">Akcje</th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('permission', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Kod Uprawnienia']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('display_name', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Nazwa']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('sort', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'Kolejność']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
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
                            <button class="btn btn-box-tool" data-toggle="collapse" data-target="#collapseBody"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div id="collapseBody" class="card-body">
                        {!! history()->renderType('Uprawnienie') !!}
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
                dom: 'frt<"d-inline-flex"i><"d-inline-flex float-right"p>',
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

            bootstrapClearButton();
            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection