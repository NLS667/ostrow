@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@section('content')
<div class="content">
	<div class="container-fluid">
  		<div class="row">
        	<div class="col-md-8">
        		<div class="card card-nav-tabs">
            		<div class="card-header card-header-text card-header-rose">
			            <div class="card-text">
			            	<h3 class="card-title">{{ $client->first_name }}&nbsp;{{ $client->last_name }}</h3>
			            </div>
			        </div>
	            	<div class="card-body ">
	            		<div class="row">
	            			<div class="col-md-4">
	            				<h4 class="card-title">Adres</h>
	            				<p class="card-text">
		                			{{$client->adr_street}}&nbsp;{{$client->adr_street_nr}}<br>
		                			{{$client->adr_zipcode}}&nbsp;{{$client->adr_city}}<br>
		                			{{$client->adr_region}}<br>
		                			{{$client->adr_country}}
		                		</p>
	            			</div>
							<div class="col-md-4">
								<h4 class="card-title">Adres</h><br>
								<a href="mailto:{{$client->email}}"><strong>{{$client->email}}</strong></a><br><br>
								<h4 class="card-title">Telefon</h><br>
		                		<strong>{{$client->phone_nr}}</strong>
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