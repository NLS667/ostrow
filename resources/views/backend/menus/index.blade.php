@extends('backend.layouts.app', ['activePage' => 'menu-management', 'titlePage' => __('Zarządzanie Menu')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card ">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Zarządzanie Menu</h4>

                        <div class="card-tools">
                            @include('backend.menus.partials.header-buttons')
                        </div>
                    </div><!-- /.box-header -->

                    <div class="card-body">
                        <div class="table-responsive data-table-wrapper">
                            <table id="menus-table" class="table table-condensed table-hover table-bordered">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>Nazwa</th>
                                        <th>Rodzaj</th>
                                        <th>Utworzone</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <thead class="transparent-bg">
                                    <tr>
                                        <th>
                                            {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => 'Nazwa']) !!}
                                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
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
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box tools -->
                    </div><!-- /.box-header -->
                    <div class="card-body">
                        {{-- {!! history()->renderType('Menu') !!} --}}
                    </div><!-- /.box-body -->
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
                dom: 'frt<"d-inline-flex"i><"d-inline-flex float-right"p>',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
