@extends('backend.layouts.app', ['activePage' => 'finance-management', 'titlePage' => 'Rozliczenia Klientów'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-icon card-header-info d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="card-icon">
                                <i class="material-icons">payments</i>
                            </div>
                            <h4 class="card-title">Finanse</h4>
                        </div>
                    </div><!-- /.card-header --> 

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="finance-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Nazwa</th>
                                        <th>Adres</th>
                                        <th>Usługa</th>
                                        <th class="text-right">Wartość umowy</th>
                                        <th class="text-right">Wpłacona zaliczka</th>
                                        <th class="text-right">Pozostało do zapłaty</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nazwa</th>
                                        <th>Adres</th>
                                        <th>Usługa</th>
                                        <th class="text-right">Wartość umowy</th>
                                        <th class="text-right">Wpłacona zaliczka</th>
                                        <th class="text-right">Pozostało do zapłaty</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('full_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Nazwa']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('address', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => 'Adres']) !!}
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
                        <!--
                        <div class="row">
                        @if (count($data) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nazwa</th>
                                    <th>Adres</th>
                                    <th>Usługa</th>
                                    <th class="text-right">Wartość umowy</th>
                                    <th class="text-right">Wpłacona zaliczka</th>
                                    <th class="text-right">Pozostało do zapłaty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $client)
                                        @foreach($client->services as $service)   
                                        <tr>
                                            @if ($loop->first)
                                            <td class="align-top" rowspan="{{ count($client->services)+1 }}">{{ $client->name }}</td>
                                            <td class="align-top" rowspan="{{ count($client->services)+1 }}">{!!html_entity_decode($client->address)!!}</td>
                                            @endif                                             
                                            <td>{{ $service->service_type_short }}</td>
                                            <td class="text-right">40000.00</td>
                                            <td class="text-right">30000.00</td>
                                            <td class="text-right">10000.00</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>RAZEM</td>
                                            <td class="text-right">total</td>
                                            <td class="text-right">total</td>
                                            <td class="text-right">total</td>
                                            <td></td> 
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                        @else

                        @endif
                        </div>
                        -->                        
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

            var dataTable = $('#finance-table').dataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: true,
                searching: true,

                ajax: {
                    url: '{{ route("admin.finance.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'first_name', name: 'clients.first_name'},
                    {data: 'adr_street', name: 'clients.adr_street'}, 
                    {data: 'service', name: 'service_categories.short_name', sortable: false}, 
                    {data: 'deal_amount', name: 'service.deal_amount', className: 'text-right'},              
                    {data: 'deal_advance', name: 'service.deal_advance', className: 'text-right'},
                    {data: 'left_amount', name: 'clients.left', className: 'text-right'}, 
                    {data: 'actions', name: 'actions', className: 'text-center', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2, 3, 5 ]  }}
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
