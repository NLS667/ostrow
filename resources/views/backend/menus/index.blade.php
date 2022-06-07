@extends('backend.layouts.app', ['activePage' => 'menu-management', 'titlePage' => __('Zarządzanie Menu')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Wszystkie Menu</h4>
                        <div class="card-tools">
                            @include('backend.menus.partials.header-buttons')
                        </div>
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="menus-table" class="table dataTable table-striped table-hover table-no-bordered dtr-inline" cellspacing="0" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nazwa</th>
                                        <th>Rodzaj</th>
                                        <th>Utworzone</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nazwa</th>
                                        <th>Rodzaj</th>
                                        <th>Utworzone</th>
                                        <th class="text-right">Akcje</th>
                                    </tr>
                                </tfoot>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            <div class="input-group position-relative">
                                                {!! Form::text('name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Nazwa']) !!}
                                                <span class="form-clear d-none reset-data"><i class="material-icons">clear</i></span>
                                            </div>
                                        </th>
                                        <th></th>
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
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-success d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Historia</h3>
                        <div class="card-tools">
                            <button class="btn btn-box-tool" data-toggle="collapse" data-target="#collapseBody"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box tools -->
                    </div><!-- /.box-header -->
                    <div id="collapseBody" class="collapse">
                        <div class="card-body">
                        {!! history()->renderType('Menu') !!}
                        </div><!--card-body-->
                    </div><!--collapse-->
                </div><!--box box-success -->
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

            var dataTable = $('#menus-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.menus.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: '{{config('access.menus_table')}}.name'},
                    {data: 'type', name: '{{config('access.menus_table')}}.type'},
                    {data: 'created_at', name: '{{config('access.menus_table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8'B><'col-sm-12 col-md-2'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5', className: 'copyButton d-none',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'csvHtml5', className: 'csvButton d-none',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'excelHtml5', className: 'excelButton d-none',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'pdfHtml5', className: 'pdfButton d-none',  exportOptions: {columns: [ 0, 1, 2 ]  }},
                        { extend: 'print', className: 'printButton d-none',  exportOptions: {columns: [ 0, 1, 2 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            bootstrapClearButton();
            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
