@extends('backend.layouts.app', ['activePage' => 'calendar', 'titlePage' => 'Kalendarz'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-text card-header-rose">
              <div class="card-text">
                <h4 class="card-title">Kalendarz</h4>
              </div>
            </div>
            <div class="card-body ">
              <calendar filter-route="{{ route('admin.task.filter') }}" resource-route="{{ route('admin.task.resource') }}" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection