@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@section('content')
<div class="content">
	<div class="container-fluid">
  		<div class="row">
        	<div class="col-md-8">
        		<div class="card">
            		<div class="card-header card-header-text card-header-rose">
			            <div class="card-text">
			            	<h3 class="card-title">{{ $client->first_name }}&nbsp;{{ $client->last_name }}</h3>
			            </div>
			        </div>
	            	<div class="card-body ">
	            		<div class="row">
	            			<div class="col-md-4">
	            				<h5 class="card-title"><strong>Adres</strong></h5>
	            				<p class="card-text">
		                			{{$client->adr_street}}&nbsp;{{$client->adr_street_nr}}<br>
		                			{{$client->adr_zipcode}}&nbsp;{{$client->adr_city}}<br>
		                			{{$client->adr_region}}<br>
		                			{{$client->adr_country}}
		                		</p>
	            			</div>
							<div class="col-md-4">
								<h5 class="card-title"><strong>Email</strong></h5>
								<a href="mailto:{{$client->email}}">{{$client->email}}</a><br><br>
								<h5 class="card-title"><strong>Telefon</strong></h5>
		                		<p class="card-text">{{$client->phone_nr}}</p>
							</div>
	            		</div>
                	</div>
            	</div>
            	<div class="card">
            		<div class="card-header">
			            <h4 class="card-title">Usługi wykonywane dla klienta</h4>
			        </div>
            		<div class="card-body">
            			<div class="row">
    						<div class="col-md-3">
    							<ul class="nav nav-pills nav-pills-primary flex-column">
    								@foreach ($client_data as $data)
    									<li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#tab_{{ $data->category }}" data-toggle="tab">{{ $data->category }}</a></li>
    								@endforeach

						        </ul>
    						</div>
    						<div class="col-md-9">
    							<div class="tab-content">
    								@foreach ($client_data as $data)
    									<div class="tab-pane @if ($loop->first) active @endif" id="tab_{{ $data->category }}">
    										<div class="row">
    											<div class="col-md-4">
    												<h4 class="title">Producent</h4>
    												<p>{{ $data->producer }}</p><br>
    												<h4 class="title">Model</h4>
    												<p>{{ $data->model }}</p>
    											</div>
    											<div class="col-md-4"></div>
    											<div class="col-md-4">
    												<h4 class="title">Data oferty</h4>
    												<p>{{ $data->service->offered_at }}</p><br>
    												<h4 class="title">Data podpisania Umowy</h4>
    												<p>{{ $data->service->signed_at }}</p>
    												<h4 class="title">Data montażu</h4>
    												<p>{{ $data->service->installed_at }}</p>
    											</div>
    										</div>
    									</div>
    								@endforeach
    							</div>
    						</div>
	            		</div>
            		</div>
            	</div>
        	</div>
        	<div class="col-md-4">
        		<div class="card ">
            		<div class="card-body ">
              			<clientsmap :data='{!! json_encode($map_data) !!}'></clientsmap>
            		</div>
          		</div>
        	</div>
    	</div>    		
  	</div>
</div>
@endsection