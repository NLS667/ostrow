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
			email:&nbsp;
			@foreach (json_decode($client->emails) as $email)
			    <a href="mailto:{{$email}}"><strong>{{$email}}</strong></a><br>
			@endforeach
			
			tel:&nbsp;
			@foreach (json_decode($client->phones) as $phone)
			    <strong>{{$phone}}</strong><br>
			@endforeach
			
		</p>
		@permission('view-client-management')
		<a class="btn btn-info"  title="Zobacz" href="{{ route('admin.client.show', $client) }}">Zobacz więcej</a>;
		@endauth
	</div>
</div>