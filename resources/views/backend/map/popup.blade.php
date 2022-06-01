<div class="card">
	<div class="card-header card-header-rose">
		<h4 class="card-title"><strong>{{ $client->first_name }}&nbsp;{{ $client->last_name }}</strong></h4>
		<p class="category"></p>
	</div>
	<div class="card-body">
		<p class="card-text">
			{{$client->adr_street}}&nbsp;{{$client->adr_street_nr}}<br>
			{{$client->adr_zipcode}}&nbsp;{{$client->adr_city}}<br>
			{{$client->adr_region}}<br>
			{{$client->adr_country}}<br><br>
			<a href="mailto:{{$client->email}}"><strong>{{$client->email}}</strong></a><br>
			<strong>{{$client->phone_nr}}</strong><br>
		</p>
	</div>
</div>