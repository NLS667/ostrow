@extends('backend.layouts.app', ['activePage' => 'service-management', 'titlePage' => 'Zarządzanie Usługami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">settings_suggest</i>
                            </div>
                            <h4 class="card-title">Wszystkie Usługi</h4>
                        </div>
                        <div class="card-tools">
                            @include('backend.includes.partials.service-header-buttons')
                        </div>
                    </div><!-- /.card-header --> 

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="services-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Typ Usługi</th>
                                        <th>Klient</th>
                                        <th>Urządzenia</th>
                                        <th>Data oferty</th>
                                        <th>Data umowy</th>
                                        <th>Data Instalacji</th>
                                        <th>Wartość Umowy</th>
                                        <th>Wpłacone zaliczki</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Typ Usługi</th>
                                        <th>Klient</th>
                                        <th>Urządzenia</th>
                                        <th>Data oferty</th>
                                        <th>Data umowy</th>
                                        <th>Data Instalacji</th>
                                        <th>Wartość Umowy</th>
                                        <th>Wpłacone zaliczki</th>
                                        <th class="text-right">Akcje</th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th></th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('client', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Klient']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('models', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'SN']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th></th>
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
                        {!! history()->renderType('Usługa') !!}
                        </div><!--card-body-->
                    </div><!--collapse-->
                </div><!--card-->
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

            var dataTable = $('#services-table').DataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: false,
                searching: true,

                ajax: {
                    url: '{{ route("admin.service.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'category', name: 'service_categories.name'},
                    {data: 'client', render: function ( data, type, row ) {
                                                return data + ' ' +row.last_name;
                                            },
                                            targets: 1,
                    },
                    {data: 'models', name: 'services.models'},
                    {data: 'offered_at', name: 'services.offered_at'},
                    {data: 'signed_at', name: 'services.signed_at'},
                    {data: 'installed_at', name: 'services.installed_at'},
                    {data: 'deal_amount', name: 'services.deal_amount', className: 'text-right'},
                    {data: 'deal_advance', name: 'services.deal_advance', className: 'text-right'},
                    {data: 'actions', name: 'actions', className: 'text-center td-actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }}
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