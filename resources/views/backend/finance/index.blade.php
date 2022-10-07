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
                                        <th class="text-right">Wpłacone zaliczki</th>
                                        <th class="text-right">Pozostało do zapłaty</th>
                                        <th class="text-right">Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nazwa</th>
                                        <th>Adres</th>
                                        <th>Usługa</th>
                                        <th class="text-right">Wartość umowy</th>
                                        <th class="text-right">Wpłacone zaliczki</th>
                                        <th class="text-right">Pozostało do zapłaty</th>
                                        <th class="text-right">Akcje</th>
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
              let amountTotal = parseFloat(+services[0].deal_amount);
              let advanceTotal = +services[0].deal_advance;
              let leftTotal = +services[0].left_amount;

              // i=1 - Skip the first service, its in the DT row.
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
                    '<td class="text-right">'+service.deal_amount.toFixed(2)+'</td>'+
                    '<td class="text-right">'+service.deal_advance.toFixed(2)+'</td>'+
                    '<td class="text-right '+style+'">'+service.left_amount.toFixed(2)+'</td>'+
                    '<td>'+service.edit_link+'</td>'+
                '</tr>';
                amountTotal += service.deal_amount;
                advanceTotal += service.deal_advance;
                leftTotal += service.left_amount;
                console.log(amountTotal);
              }
              if(leftTotal == '0.00'){
                    var newStyle = 'text-success';
                } else {
                    newStyle = 'text-danger';
                }
              html += '<tr>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td><strong>RAZEM</strong></td>'+
                    '<td class="text-right"><strong>'+amountTotal.toFixed(2)+'</strong></td>'+
                    '<td class="text-right"><strong>'+advanceTotal.toFixed(2)+'</strong></td>'+
                    '<td class="text-right '+newStyle+'"><strong>'+leftTotal.toFixed(2)+'</strong></td>'+
                    '<td></td>'+
                '</tr>';
              
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
                    {data: 'name', "render": function ( data, type, row, meta ) {
                        return '<strong>'+data+'</strong>';
                        }
                    },
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
                            return service.deal_amount.toFixed(2);
                        }
                        return "";
                        }
                    },
                    {data: 'services', className: "text-right", "render": function ( data, type, row, meta ) {
                        if(data==null) return "";
                        for(var i=0, num=data.length; i<num; i++) {
                            var service = data[i];
                            return service.deal_advance.toFixed(2);
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
                          return '<span style="color:' + color + '">' + service.left_amount.toFixed(2) + '</span>';
                        }
                        return "";
                        }
                    },
                    {data: 'actions', name: 'actions', className: 'text-center', "render": function ( data, type, row, meta ) {
                        if(data==null) return "";
                        console.log(data);
                        for(var i=0, num=data.length; i<num; i++) {
                            var button = data[i];
                            return button.edit_link;
                        }
                        return "";
                        }
                    }
                ],
                drawCallback: function (settings) {
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
