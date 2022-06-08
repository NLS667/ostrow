@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

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
	            				<h6>Adres</h6>
	            				<p class="card-text">
		                			{{$client->adr_street}}&nbsp;{{$client->adr_street_nr}}<br>
		                			{{$client->adr_zipcode}}&nbsp;{{$client->adr_city}}<br>
		                			{{$client->adr_region}}<br>
		                			{{$client->adr_country}}
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
    											<div class="col-md-4">
    												<h6>Producent</h6>
    												<p class="category">{{ $data->producer }}</p>
    												<h6>Model</h6>
    												<p>{{ $data->model }}</p>
    											</div>
    											<div class="col-md-4"></div>
    											<div class="col-md-4">
    												<h6>Data oferty</h6>
    												<p>{{ $data->service->offered_at }}</p>
    												<h6>Data podpisania Umowy</h6>
    												<p>{{ $data->service->signed_at }}</p>
    												<h6>Data montażu</h6>
    												<p>{{ $data->service->installed_at }}</p>
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
            			<textarea name="content" class="form-control my-editor">{!! old('content', $content) !!}</textarea>
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

@section('after-scripts')
	<script>
  var editor_config = {
    path_absolute : "/",
    selector: 'textarea.my-editor',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection