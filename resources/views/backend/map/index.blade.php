@extends('backend.layouts.app', ['activePage' => 'client-map', 'titlePage' => 'Mapa Klientów'])

@section('content')
  <div class="content" style="padding:none;">
    <clientsmap :data='{!! json_encode($map_data) !!}'></clientsmap>
  </div>
@endsection