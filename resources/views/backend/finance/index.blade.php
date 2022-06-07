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
                        <div class="row">
                        @if (count($data) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nazwa</th>
                                    <th>Adres</th>
                                    <th>Usługa</th>
                                    <th>Wartość umowy</th>
                                    <th>Wpłacona zaliczka</th>
                                    <th>Pozostało do zapłaty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $client)
                                        @foreach($client->services as $service)   
                                        <tr>
                                            @if ($loop->first)
                                            <td class="align-top" rowspan="{{ $services->count() }}">{{ $client->name }}</td>
                                            <td class="align-top" rowspan="{{ $services->count() }}">{!!html_entity_decode($client->address)!!}</td>
                                            @endif                                             
                                            <td>{{ $service->service_type_short }}</td>
                                            <td>40000.00</td>
                                            <td>30000.00</td>
                                            <td>10000.00</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                @endforeach
                            </tbody>
                        </table>                        
                        @else

                        @endif
                        </div>
                    </div><!-- /.card-body -->
                </div><!--card-->
            </div>
        </div>
    </div>
</div>
@endsection
