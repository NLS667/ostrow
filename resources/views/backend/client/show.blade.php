@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/dropzone.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/mime-icons.min.css') }}">
@endpush

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
	            				<h6>Adres montażu</h6>
	            				<p class="card-text">
		                			{{$client->adr_street}}&nbsp;{{$client->adr_street_nr}}<br>
		                			{{$client->adr_zipcode}}&nbsp;{{$client->adr_city}}<br>
		                			{{$client->adr_region}}<br>
		                			{{$client->adr_country}}
		                		</p>
	            			</div>
                    <div class="col-md-4">
                      <h6>Adres korespondencyjny</h6>
                      <p class="card-text">
                          {{$client->comm_adr_street}}&nbsp;{{$client->comm_adr_street_nr}}<br>
                          {{$client->comm_adr_zipcode}}&nbsp;{{$client->comm_adr_city}}<br>
                          {{$client->comm_adr_region}}<br>
                          {{$client->comm_adr_country}}
                        </p>
                    </div>
      							<div class="col-md-4">
      								<h6>Email</h5>
      								<a href="mailto:{{$client->email}}">{{$client->email}}</a><br><br>
      								<h6>Telefon</h6>
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
                          <div class="col-md-3">
                            <h6>Data oferty</h6>
                            <p>{{ $data->service->offered_at }}</p>
                          </div>
                          <div class="col-md-3">
                            <h6>Data podpisania Umowy</h6>
                            <p>{{ $data->service->signed_at }}</p>
                          </div>
                          <div class="col-md-3">
                            <h6>Data montażu</h6>
                            <p>{{ $data->service->installed_at }}</p>
                          </div>
                          <div class="col-md-3">
                            <a class="btn btn-round btn-rose" href="{{ url('admin/service/'.$data->service->id.'/edit/') }}">Edytuj usługę</a>
                          </div>
                        </div>
    										<div class="row">
                          <div class="col-md-12">
                            <h4>Urządzenia:</h4>
                          </div>
                        </div>

                        <div class="row">
    											<div class="col-md-4">
    												<h6>Producent</h6>
    												<p>{{ $data->producer }}</p>
    											</div>
    											<div class="col-md-4">
                            <h6>Model</h6>
                            <p>{{ $data->model }}</p>           
                          </div>
    											<div class="col-md-4">										
    												<h6>Numer Seryjny</h6>
                            <p>{{ $data->serial_number }}</p>    												
    											</div>
    										</div>

    									</div>
    								@endforeach
    							</div>
    						</div>
	            		</div>
            		</div>
            	</div>
            	<div class="card">
            		<div class="card-body">
            			<div class="lfm-wrapper" style="position:relative;">
            				@include('backend.client.partials.lfm');
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
            @if(!empty($task_data))
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Zadania przypisane do klienta</h4>
                </div>
                <div class="card-body ">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Usługa</th>
                        <th scope="col">Data</th>
                        <th scope="col">Pracownik</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($task_data as $task)
                      <tr class="{{ $task->status }}">
                        <td>{{ $task->service }}</td>
                        <td>{{ $task->start }}</td>
                        <td>{{ $task->assignee }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            @endif
        	</div>
    	</div>    		
  	</div>
</div>
@endsection

@section('after-scripts')
<script src="{{ asset('vendor/laravel-filemanager/js/cropper.min.js') }}"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/dropzone.min.js') }}"></script>
  <script>
    var lang = {!! json_encode(trans('laravel-filemanager::lfm')) !!};
    var actions = [
      // {
      //   name: 'use',
      //   icon: 'check',
      //   label: 'Confirm',
      //   multiple: true
      // },
      //{
      // name: 'rename',
      //  icon: 'edit',
      //  label: lang['menu-rename'],
      //  multiple: false
      //},
      {
        name: 'download',
        icon: 'download',
        label: lang['menu-download'],
        multiple: true
      },
      // {
      //   name: 'preview',
      //   icon: 'image',
      //   label: lang['menu-view'],
      //   multiple: true
      // },
      {
        name: 'move',
        icon: 'paste',
        label: lang['menu-move'],
        multiple: true
      },
      //{
      //  name: 'resize',
      //  icon: 'arrows-alt',
      //  label: lang['menu-resize'],
      //  multiple: false
      //},
      //{
      //  name: 'crop',
      //  icon: 'crop',
      //  label: lang['menu-crop'],
      //  multiple: false
      //},
      {
        name: 'trash',
        icon: 'trash',
        label: lang['menu-delete'],
        multiple: true
      },
    ];

    var sortings = [
      {
        by: 'alphabetic',
        icon: 'sort-alpha-down',
        label: lang['nav-sort-alphabetic']
      },
      {
        by: 'time',
        icon: 'sort-numeric-down',
        label: lang['nav-sort-time']
      }
    ];
  </script>
  {{-- <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script> --}}
  {{-- Use the line below instead of the above if you need to cache the script. --}}
  <script src="{{ asset('vendor/laravel-filemanager/js/script.js') }}"></script>
  <script>
    Dropzone.options.uploadForm = {
      paramName: "upload[]", // The name that will be used to transfer the file
      uploadMultiple: false,
      parallelUploads: 5,
      timeout:0,
      clickable: '#upload-button',
      dictDefaultMessage: lang['message-drop'],
      init: function() {
        var _this = this; // For the closure
        this.on('success', function(file, response) {
          if (response == 'OK') {
            loadFolders();
          } else {
            this.defaultOptions.error(file, response.join('\n'));
          }
        });
      },
      headers: {
        'Authorization': 'Bearer ' + getUrlParam('token')
      },
      acceptedFiles: "{{ implode(',', $helper->availableMimeTypes()) }}",
      maxFilesize: ({{ $helper->maxUploadSize() }} / 1000)
    }
  </script>
  @endsection