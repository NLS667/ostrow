@extends ('backend.layouts.app', ['activePage' => 'user-deactivated', 'titlePage' => 'Zarządzanie Użytkownikami']) 

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">people</i>
                            </div>
                            <h4 class="card-title">Nieaktywni Użytkownicy</h4>
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
                    </div><!-- /.box-body -->
                </div><!--box-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    <script>

        (function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataTable = $('#users-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.access.user.get") }}',
                    type: 'post',
                    data: {status: 0, trashed: false}
                },
                columns: [
                    {data: 'first_name', name: '{{config('access.users_table')}}.first_name'},
                    {data: 'last_name', name: '{{config('access.users_table')}}.last_name'},
                    {data: 'email', name: '{{config('access.users_table')}}.email'},
                    {data: 'status', name: '{{config('access.users_table')}}.status'},
                    {data: 'roles', name: '{{config('access.roles_table')}}.name', sortable: false},
                    {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                    {data: 'actions', name: 'action', className: 'text-center td-actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            Backend.DataTableSearch.init(dataTable);
            bootstrapClearButton();
        })();
       
    </script>
@endsection
