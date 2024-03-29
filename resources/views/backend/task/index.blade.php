@extends('backend.layouts.app', ['activePage' => 'task-management', 'titlePage' => 'Zarządzanie Zadaniami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">task_alt</i>
                            </div>
                            <h4 class="card-title">Aktywne Zadania</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.includes.partials.task-header-buttons')
                        </div>
                    </div><!-- /.card-header --> 

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="tasks-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Pracownik</th>
                                        <th>Rodzaj</th>
                                        <th>Usługa</th>
                                        <th>Data rozpoczęcia</th>
                                        <th>Data zakończenia</th>
                                        <th>Status</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Pracownik</th>
                                        <th>Rodzaj</th>
                                        <th>Usługa</th>                                        
                                        <th>Data rozpoczęcia</th>
                                        <th>Data zakończenia</th>
                                        <th>Status</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                        <th class="text-right">Akcje</th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('assignee', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Pracownik']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('type', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Rodzaj']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('service', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'Usługa']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::select('status', [ 'Nowe' => 'Nowe', 'Oczekujące' => 'Oczekujące', 'Nadchodzące' => 'Nadchodzące', 'Po terminie' => 'Po terminie'], $q_status, ["class" => "search-input-select form-control", "data-column" => 5, "placeholder" => 'Status']) !!}
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
                    <div id="collapseBody" class="collapse">
                        <div class="card-body">
                        {!! history()->renderType('Zadanie') !!}
                        </div><!--card-body-->
                    </div><!--collapse-->
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

            var dataTable = $('#tasks-table').DataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: false,
                searching: true,

                ajax: {
                    url: '{{ route("admin.task.get") }}',
                    type: 'post',
                    data: {isPlanned: 0, trashed: false}
                },
                columns: [
                    {data: 'assignee', name: 'assignee_name'},
                    {data: 'type', name: 'task_type'},
                    {data: 'service', name: 'title'},                    
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'status', render: function ( data, type, row, meta ) {
                        let output = '';
                        switch (data) {
                            case 0:
                                output = '<span class="badge badge-default">Nowe</span>';
                                break;
                            case 1:
                                output = '<span class="badge badge-success">Oczekujące</span>';
                                break;
                            case 2:
                                output = '<span class="badge badge-warning">Nadchodzące</span>';
                                break;
                            case 3:
                                output = '<span class="badge badge-danger">Po terminie</span>';
                                break;
                            case 4:
                                output = '<span class="badge badge-info">Zakończone</span>';
                        }

                        return output;
                    }},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', className: 'text-center td-actions', searchable: false, sortable: false}
                ],
                order: [[5, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });       

            Backend.DataTableSearch.init(dataTable);
            bootstrapClearButton();

            var q_search = '{{ $q_status }}';
            if(q_search){
                dataTable.columns( 5 ).search( q_search ).draw();
            }
    
        });
    </script>
@endsection