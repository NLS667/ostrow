@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

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
                            <h4 class="card-title">Aktywni Klienci</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.includes.partials.client-header-buttons')
                        </div>
                    </div><!-- /.card-header --> 

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="clients-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>Adres montażu</th>
                                        <th>Adres koresp.</th>
                                        <th>Nr telefonu</th>
                                        <th>E-mail</th>                                        
                                        <th>Serwis</th>
                                        <th>Usługi</th>
                                        <th>Rok p.u.</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>Adres montażu</th>
                                        <th>Adres koresp.</th>
                                        <th>Nr telefonu</th>
                                        <th>E-mail</th>                                        
                                        <th>Serwis</th>
                                        <th>Usługi</th>
                                        <th>Rok p.u.</th>
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
                                                {!! Form::text('adr_street', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'Adres montażu']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('comm_adr_street', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'Adres koresp.']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('phone_nr', null, ["class" => "search-input-text form-control", "data-column" => 3, "placeholder" => 'Nr telefonu']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 4, "placeholder" => 'Email']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th></th>
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
                        {!! history()->renderType('Klient') !!}
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

            var dataTable = $('#clients-table').DataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: false,
                searching: true,

                ajax: {
                    url: '{{ route("admin.client.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'first_name', name: 'clients.first_name'},
                    {data: 'last_name', name: 'clients.last_name'},
                    {data: 'adr_street', name: 'clients.adr_street'},
                    {data: 'comm_adr_street', name: 'clients.comm_adr_street'},                    
                    {data: 'phones', name: 'clients.phones'},
                    {data: 'emails', name: 'clients.emails'},              
                    {data: 'service_status', className: 'text-center', name: 'tasks.status', render: function ( data, type, row, meta ) {
                        switch(data){
                            case 0:
                                return '<span class="badge badge-default">BRAK ZADAŃ</a>';
                                break;
                            case 1:
                                return '<span class="badge badge-success">OK</a>';
                                break;
                            case 2:
                                return '<span class="badge badge-warning">ZAPLANUJ</a>';
                                break;
                            case 3:
                                return '<span class="badge badge-danger">PO TERMINIE</a>';
                                break;
                            case 4:
                                return '<span class="badge badge-default">BRAK ZADAŃ</a>';
                                break;
                        }
                    }},
                    {data: 'services', name: 'service_categories.name', sortable: false},  
                    {data: 'created_at', name: 'clients.created_at'},
                    {data: 'actions', name: 'actions', className: 'text-center td-actions', searchable: false, sortable: false}
                ],
                order: [[5, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6, 7 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6 ,7 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6, 7 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6, 7 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5, 6, 7 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            Backend.DataTableSearch.init(dataTable);

            function compareNumbers(a, b) {
               return a - b
            }

            bootstrapClearButton();
    
        });
    </script>
@endsection