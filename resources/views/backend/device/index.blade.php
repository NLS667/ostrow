@extends('backend.layouts.app', ['activePage' => 'device-management', 'titlePage' => 'Zarządzanie Urządzeniami'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">memory</i>
                            </div>
                            <h4 class="card-title">Wszystkie Urządzenia</h4>
                        </div>
                        <div class="card-tools"></div>
                    </div><!-- /.card-header --> 

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="devices-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Numer Seryjny</th>
                                        <th>Producent</th>
                                        <th>Model</th>
                                        <th>Usługa</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Numer Seryjny</th>
                                        <th>Producent</th>
                                        <th>Model</th>
                                        <th>Usługa</th>
                                        <th>Utworzony</th>
                                        <th>Zmieniony</th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('serial_number', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Numer Seryjny']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('producer', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Producent']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('model', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => 'Model']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('service', null, ["class" => "search-input-text form-control", "data-column" => 3, "placeholder" => 'Usługa']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!--table-responsive-->
                    </div><!-- /.card-body -->
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

            var dataTable = $('#devices-table').DataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: false,
                searching: true,

                ajax: {
                    url: '{{ route("admin.device.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'serial_number', name: 'devices.serial_number'},
                    {data: 'producer', name: 'devices.producer'},
                    {data: 'model', name: 'devices.model'},
                    {data: 'service', name: 'devices.service'},
                    {data: 'created_at', name: 'devices.created_at'},
                    {data: 'updated_at', name: 'devices.updated_at'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }}
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