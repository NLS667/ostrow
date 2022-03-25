@extends('backend.layouts.app', ['activePage' => 'user-management', 'titlePage' => 'Zarządzanie Użytkownikami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">face</i>
                            </div>
                            <h4 class="card-title">Aktywni Użytkownicy</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.access.includes.partials.user-header-buttons')
                        </div>
                    </div><!-- /.card-header --> 

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="users-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>E-mail</th>
                                        <th>Aktywny?</th>
                                        <th>Role</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>E-mail</th>
                                        <th>Aktywny?</th>
                                        <th>Role</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                        <th class="text-right">Akcje</th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Imię']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('last_name', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Nazwisko']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'email']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('roles', null, ["class" => "search-input-text form-control", "data-column" => 4, "placeholder" => 'Rola']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-success d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Historia</h4>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-round" data-toggle="collapse"  data-target="#collapseBody"><i class="fa fa-minus"></i></button>
                        </div><!-- /.card tools -->
                    </div><!-- /.card-header -->
                    <div id="collapseBody" class="card-body">
                        {!! history()->renderType('Użytkownik') !!}
                    </div><!-- /.card-body -->
                </div><!--card box-info-->
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

            var dataTable = $('#users-table').dataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: true,
                searching: true,

                ajax: {
                    url: '{{ route("admin.access.user.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'first_name', name: '{{config('access.users_table')}}.first_name'},
                    {data: 'last_name', name: '{{config('access.users_table')}}.last_name'},
                    {data: 'email', name: '{{config('access.users_table')}}.email'},
                    {data: 'confirmed', className: 'text-center', name: '{{config('access.users_table')}}.confirmed', render: function ( data, type, row, meta ) {
                        if(data=1) {
                            return '<span class="badge badge-success">Tak</a>';
                        } else {
                            return '<span class="badge badge-danger">Nie</a>';
                        }
                    }},
                    {data: 'roles', name: '{{config('access.roles_table')}}.name', className: 'text-center', sortable: false},
                    {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                    {data: 'actions', name: 'actions', className: 'text-center', searchable: false, sortable: false}
                ],
                order: [[5, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            Backend.DataTableSearch.init(dataTable);
            bootstrapClearButton();
    
        });
    </script>
@endsection