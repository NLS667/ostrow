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

            function displayServices(services) {
  
              var html = '';
              
              // i=1 - Skip the first house, its in the DT row.
              for (i=1; i<services.length; i++) {
                var service = services[i];
                if(service.left_amount == '0.00'){
                    var style = 'text-success';
                } else {
                    style = 'text-danger';
                }

                html += '<tr>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>'+service.short_name+'</td>'+
                    '<td class="text-right">'+service.deal_amount+'</td>'+
                    '<td class="text-right">'+service.deal_advance+'</td>'+
                    '<td class="text-right '+style+'">'+service.left_amount+'</td>'+
                    '<td></td>'+
                '</tr>';
              }
              
              return $(html).toArray();
            }

            var dataTable = $('#finance-table').dataTable({
                columnDefs: [
                    {"className": "dt-center", "targets": "_all"},
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
                    {data: 'name'},
                    {data: 'address'}, 
                    {data: 'services', "render": function ( data, type, row, meta ) {
                        if(data==null) return "";
                        for(var i=0; i<data.length; i++) {
                            var service = data[i];
                            return service.short_name;
                        }
                        return "";
                        }
                    },
                    {data: 'services', className: "text-right", "render": function ( data, type, row, meta ) {
                        if(data==null) return "";
                        for(var i=0, num=data.length; i<num; i++) {
                            var service = data[i];
                            return service.deal_amount;
                        }
                        return "";
                        }
                    },
                    {data: 'services', className: "text-right", "render": function ( data, type, row, meta ) {
                        if(data==null) return "";
                        for(var i=0, num=data.length; i<num; i++) {
                            var service = data[i];
                            return service.deal_advance;
                        }
                        return "";
                        }
                    },
                    {data: 'services', className: "text-right", "render": function ( data, type, row, meta ) {
                        if(data==null) return "";
                        for(var i=0, num=data.length; i<num; i++) {
                            var service = data[i];
                            if (service.left_amount == '0.00') {
                                var color = 'green';
                              } else {
                                color = 'red';
                              }
                          return '<span style="color:' + color + '">' + service.left_amount + '</span>';
                        }
                        return "";
                        }
                    },
                    {data: 'actions', name: 'actions', className: 'text-center', searchable: false, sortable: false}
                ],
                initComplete: function (settings, json) {
                   
                    var api = this.api();
                      
                    api.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                        var data = this.data();
                        
                        if (data.services) {
                            this.child( displayServices(data.services) ).show();
                        }
                    });
                },
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
