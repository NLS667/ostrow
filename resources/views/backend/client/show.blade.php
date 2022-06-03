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
	            		<div class="row">
    						<div class="col-md-4">
    							<ul class="nav nav-pills nav-pills-primary flex-column">
    								@foreach ($serviceCategories as $category)
    									<li class="nav-item"><a class="nav-link" href="#tab_{{ $category->name }}" data-toggle="tab">{{ $category->name }}</a></li>
    								@endforeach

						        </ul>
    						</div>
    						<div class="col-md-8">
    							<div class="tab-content">
    								@foreach ($serviceCategories as $category)
    									<div class="tab-pane active" id="tab_{{ $category->name }}">{{ $category->description }}</div>
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