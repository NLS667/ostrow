@extends('backend.layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
    <div class="card card-info">
        <div class="card-header with-border">
            <h3 class="card-title">{{ trans('labels.backend.access.users.management') }}</h3>

            <div class="card-tools float-right action-tools">
                @include('backend.access.includes.partials.user-header-buttons')
            </div>
        </div><!-- /.card-header -->

        <div class="card-body">
            <div class="table-responsive data-table-wrapper">
                <table id="users-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.users.table.first_name') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.last_name') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.confirmed') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.roles') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.created') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.access.users.table.first_name')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                                </th>
                            <th>
                                {!! Form::text('last_name', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.access.users.table.last_name')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => trans('labels.backend.access.users.table.email')]) !!}
                                    <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                            </th>
                            <th></th>
                            <th>
                            {!! Form::text('roles', null, ["class" => "search-input-text form-control", "data-column" => 4, "placeholder" => trans('labels.backend.access.users.table.roles')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.card-body -->
    </div><!--card-->

    <div class="card card-info">
        <div class="card-header with-border">
            <h3 class="card-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="card-tools pull-right">
                <button class="btn btn-card-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.card tools -->
        </div><!-- /.card-header --> -->
        <div class="card-body">
            {{-- {!! history()->renderType('User') !!} --}}
        </div><!-- /.card-body -->
    </div><!--card box-info-->
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

            var dataTable = $('#users-table').dataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: true,
                searching: false,

                ajax: {
                    url: '{{ route("admin.access.user.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'first_name', name: '{{config('access.users_table')}}.first_name'},
                    {data: 'last_name', name: '{{config('access.users_table')}}.last_name'},
                    {data: 'email', name: '{{config('access.users_table')}}.email'},
                    {data: 'confirmed', name: '{{config('access.users_table')}}.confirmed', render: function ( data, type, row, meta ) {
                        if(data=1) {
                            return '<span class="badge badge-success">Confirmed</a>';
                        } else {
                            return '<span class="badge badge-danger">Unconfirmed</a>';
                        }
                    }},
                    {data: 'roles', name: '{{config('access.roles_table')}}.name', sortable: false},
                    {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'frt<"d-inline-flex"i><"d-inline-flex float-right"p>',
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
        });
    </script>
@endsection