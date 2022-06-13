@extends('backend.layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'Pulpit'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      @permission('view-client-management')
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">face</i>
              </div>
              <p class="card-category">Klienci</p>
              <h3 class="card-title">{{ $data['clientCount'] }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">history</i> Przed chwilą
              </div>
              <a href="{{ route('admin.client.index') }}" class="btn btn-sm btn-flat btn-info">Zobacz</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add_task</i>
              </div>
              <p class="card-category">Nowe Zadania</p>
              <h3 class="card-title">{{ $data['newTaskCount'] }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Wszystkie w bazie
              </div>
              <a href="{{ route('admin.task.index', ['q_status' => 'Nowe']) }}" class="btn btn-sm btn-flat btn-info">Zobacz</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">alarm</i>
              </div>
              <p class="card-category">Nadchodzące Zadania</p>
              <h3 class="card-title">{{ $data['comingTaskCount'] }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Najbliższy miesiąc
              </div>
              <a href="{{ route('admin.task.index', ['q_status' => 'Nadchodzące']) }}" class="btn btn-sm btn-flat btn-info">Zobacz</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Zadania po terminie</p>
              <h3 class="card-title">{{ $data['overdueTaskCount'] }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">history</i> Przed chwilą
              </div>
            </div>
          </div>
        </div>
      </div>
      @endauth
      @permission('view-map')
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
      @endauth
      @permission('view-calendar')
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-text card-header-rose">
              <div class="card-text">
                <h4 class="card-title">Harmonogram</h4>
              </div>
            </div>
            <div class="card-body ">
              <calendar filter-route="{{ route('admin.task.filter') }}" />
            </div>
          </div>
        </div>
      </div>
      @endauth
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush