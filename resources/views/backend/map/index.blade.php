@extends('backend.layouts.app', ['activePage' => 'client-map', 'titlePage' => 'Mapa Klientów'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-text card-header-rose">
              <div class="card-text">
                <h4 class="card-title">Mapa Klientów</h4>
              </div>
            </div>
            <div class="card-body ">
              <clientsmap :data='{!! json_encode($map_data) !!}'></clientsmap>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection