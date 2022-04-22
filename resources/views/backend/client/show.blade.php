@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@section('content')
<div class="content">
	<div class="container-fluid">
  		<div class="row">
        	<div class="col-md-8">
        		<div class="card ">
        			<div class="card-header card-header-icon card-header-primary">
	                	<div class="col-md-6">
	                  		<div class="card-icon">
	                    		<i class="material-icons">face</i>
	                  		</div>
	                  		<h4 class="card-title">Mapa</h4>
	                	</div>
	            	</div>
            		<div class="card-body ">
              			<clientsmap :data='{!! json_encode($map_data) !!}'></clientsmap>
            		</div>
          		</div>
        	</div>
    	</div>
    	<div class="col-md-4">
        		<div class="card">
        			<div class="card-header card-header-text card-header-rose">
              			<div class="card-text">
                			<h4 class="card-title">Dane Podstawowe</h4>
              			</div>
            		</div>
	            	<div class="card-body ">
                		<div class="row">

                		</div>
                	</div>
            	</div>
        	</div>
  	</div>
</div>
@endsection