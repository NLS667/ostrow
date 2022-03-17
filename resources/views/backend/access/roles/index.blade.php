@extends('backend.layouts.app', ['activePage' => 'role-management', 'titlePage' => 'Zarządzanie Rolami'])

@section('content')
    <div class="card">
        <div class="card-header card-header-info d-flex justify-content-between align-items-center">
            <h4 class="card-title">Zarządzanie Rolami</h4>
            <div class="box-tools float-right">
                @include('backend.access.includes.partials.role-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="card-body">
            <div class="table-responsive data-table-wrapper">
                <table id="roles-table" class="table table-condensed table-hover table-bordered">
                    <thead class=" text-primary">
                        <tr>
                            <th>Rola</th>
                            <th>Uprawnienia</th>
                            <th>Ilość użytkowników</th>
                            <th>Kolejność</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('role', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Rola']) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('permission', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Uprawnienie']) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                            </th>
                            <th></th>
                            <th>
                            {!! Form::text('sort', null, ["class" => "search-input-text form-control", "data-column" => 3, "placeholder" => 'Kolejność']) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="card box-info">
        <div class="card-header card-header-success d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ trans('history.backend.recent_history') }}</h4>
            <div class="card-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header --> -->
        <div class="card-body">
            {{-- {!! history()->renderType('Role') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-info-->
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

            var dataTable = $('#roles-table').dataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: '{{ route("admin.access.role.get") }}',
                    type: 'post',
                },
                columns: [
                    {data: 'name', name: '{{config('access.roles_table')}}.name'},
                    {data: 'permissions', name: '{{config('access.permissions_table')}}.display_name', sortable: false},
                    {data: 'users', name: 'users', searchable: false, sortable: false},
                    {data: 'sort', name: '{{config('access.roles_table')}}.sort'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }}
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