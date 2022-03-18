@extends ('backend.layouts.app', ['activePage' => 'user-deleted', 'titlePage' => 'Usunięci Użytkownicy'])


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Usunięci Użytkownicy</h3>

                        <div class="card-tools">
                            @include('backend.access.includes.partials.user-header-buttons')
                        </div><!--box-tools pull-right-->
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="users-table" class="table table-condensed table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>E-mail</th>
                                        <th>Potwierdzony ?</th>
                                        <th>Role</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Imię']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                        </th>
                                        <th>
                                            {!! Form::text('last_name', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Nazwisko') !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                        </th>
                                        <th>
                                            {!! Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'E-mail']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                        </th>
                                        <th></th>
                                        <th>
                                            {!! Form::text('roles', null, ["class" => "search-input-text form-control", "data-column" => 4, "placeholder" => 'Role']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
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
                        data: {status: false, trashed: true}
                    },
                    columns: [
                        {data: 'first_name', name: '{{config('access.users_table')}}.first_name'},
                        {data: 'last_name', name: '{{config('access.users_table')}}.last_name'},
                        {data: 'email', name: '{{config('access.users_table')}}.email'},
                        {data: 'confirmed', name: '{{config('access.users_table')}}.confirmed'},
                        {data: 'roles', name: '{{config('access.roles_table')}}.name', sortable: false},
                        {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                        {data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    dom: 'frt<"d-inline-flex"i><"d-inline-flex float-right"p>',
                    buttons: {
                        buttons: [
                            { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }}
                        ]
                    },
                    language: {
                        @lang('datatable.strings')
                    }
                });
    
                Backend.DataTableSearch.init(dataTable);

                Backend.UserDeleted.selectors.Areyousure = "Czy na pewno?";
                Backend.UserDeleted.selectors.delete_user_confirm = "Potwierdź usunięcie użytkownika";
                Backend.UserDeleted.selectors.continue = "Dalej";
                Backend.UserDeleted.selectors.cancel ="Anuluj";
                Backend.UserDeleted.selectors.restore_user_confirm ="Potwierdź przywrócenei użytkownika";
            
            })();

            
     
        window.onload = function(){
            
            Backend.UserDeleted.windowloadhandler();
        }
          
	</script>
@endsection
