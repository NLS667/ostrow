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
                                            <td class="text-right"">total</td>
                                            <td class="text-right"">total</td>
                                            <td class="text-right"">total</td>
                                            <td></td> 
                                        </tr>
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
