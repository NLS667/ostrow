@extends('backend.layouts.app', ['activePage' => 'client-management', 'titlePage' => 'Zarządzanie Klientami'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/dropzone.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/mime-icons.min.css') }}">
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
      <ul class="nav nav-pills" id="nav-tab" role="tablist">
          <li class="nav-item">
            <a href="#nav-general" class="nav-link active" id="nav-general-tab" data-toggle="tab" data-bs-target="#nav-general" type="button" role="tab">Ogólne</a>
          </li>
          <li class="nav-item">
            <a href="#nav-tasks"  class="nav-link" id="nav-tasks-tab" data-toggle="tab" data-bs-target="#nav-tasks" type="button" role="tab">Zadania</a>
          </li>
          <li class="nav-item">          
            <a href="#nav-notes"  class="nav-link" id="nav-notes-tab" data-toggle="tab" data-bs-target="#nav-notes" type="button" role="tab">Notatki</a>
          </li>
      </ul>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane active" id="nav-general" role="tabpanel">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                  <div class="card-header card-header-icon card-header-rose d-flex justify-content-between align-items-center">
                    <div class="card-text">
                      <h3 class="card-title">{{ $client->first_name }}&nbsp;{{ $client->last_name }}</h3>
                    </div>
                    <div class="card-tools" style="margin-top:10px;">
                        <a class="btn btn-round btn-rose" href="{{ url('admin/client/'.$client->id.'/edit/') }}">Edytuj dane</a>
                    </a>
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
                        <h6>Kontakty</h5>
                        @php
                        $emails = json_decode($client->emails);
                        $phones = json_decode($client->phones);
                        $contacts = json_decode($client->contacts);
                        @endphp
                        @for($i = 0; $i < count($contacts); $i++)
                        <p class="card-text"><b>{{$contacts[$i]}}</b>: <a href="mailto:{{$emails[$i]}}">{{$emails[$i]}}</a>; tel. {{$phones[$i]}}</p>
                        @endfor
                      </div>
                    </div>
                    </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Notatki / Dodatkowe informacje</h4>
                  </div>
                  <div class="card-body">
                    <p>{{$client->extra_info}}</p>
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
                            </div>
                            <div class="col-md-4">
                              <h6>Model</h6>          
                            </div>
                            <div class="col-md-4">                    
                              <h6>Numer Seryjny</h6>                           
                            </div>
                          </div>
                          @foreach($data->models as $model)
                          <div class="row">
                            <div class="col-md-4">
                              <p>{{ $model->producer }}</p>
                            </div>
                            <div class="col-md-4">
                              <p>{{ $model->name }}</p>           
                            </div>
                            <div class="col-md-4">
                              <p style="text-transform: uppercase;">{{ $model->serial_number }}</p>                            
                            </div>
                          </div>
                          @endforeach

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
            </div>
          </div>
        </div>
        <div class="tab-pane" id="nav-tasks" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Zadania przypisane do klienta</h4>
                </div>
                <div class="card-body ">
                  @if(!empty($task_data))
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Usługa</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Data</th>
                        <th scope="col">Pracownik</th>
                        <th scope="col">Akcje</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($task_data as $task)
                      <tr class="{{ $task->status }}">
                        <td>{{ $task->service }}</td>
                        <td>{{ $task->tasktype }}</td>
                        <td>{{ $task->start }}</td>
                        <td>{{ $task->assignee }}</td>
                        <td class="td-actions">{!! $task->edit_link !!}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @endif
                </div>
            </div>
        </div>
        <div class="tab-pane" id="nav-notes" role="tabpanel">
          
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Notatki / Dodatkowe informacje</h4>
            </div>
            <div class="card-body">
              <div class="row">
                @if(!empty($notes))
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Data Utworzenia</th>                        
                          <th scope="col">Notatka</th>
                          <th scope="col">Utworzył/a</th>
                          <th scope="col">Akcje</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($notes as $note)
                        <tr>
                          <td>{{ $note->created_at }}</td>
                          <td>{{ $note->content }}</td>
                          <td>{{ $note->created_by }}</td>
                          <td class="td-actions">{!! $note->action_buttons !!}</td>
                        </tr>
                        @endforeach
                      </tbody>
                </table>
                @endif
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <button type="button" name="add_note" id="add_note" class="btn btn-primary" data-toggle="modal" data-target="#newNoteModal">Dodaj notatkę</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  	</div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="newNoteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nowa Notatka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="SubmitForm">
        @csrf
        <div class="modal-body">
          <textarea rows="8" cols="50" class="form-control" name="content" id="input-content"></textarea>
          <span class="text-danger" id="contentErrorMsg"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edytuj Notatkę</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="UpdateForm">
        @csrf
        <div class="modal-body">
          <textarea rows="8" cols="50" class="form-control" name="content" id="input-update-content"></textarea>
          <span class="text-danger" id="contentErrorMsg"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <button id="updateButton" type="submit" value="" class="btn btn-primary">Zmień</button>
        </div>
      </form>
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
  <script type="text/javascript">
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');
        
        if(activeTab){
            $('#nav-tab a[href="' + activeTab + '"]').tab('show');
        }
    });
    $('#SubmitForm').on('submit',function(e){
      e.preventDefault();

      let content = $('#input-content').val();
      let client_id = @json($client->id);
      
      $.ajax({
        url: "/admin/note/add-note",
        type:"POST",
        data:{
          "_token": "{{ csrf_token() }}",
          content:content,
          client_id:client_id,
        },
        success:function(response){
          window.location.reload();          
          $('#newNoteModal').modal('hide');
        },
        error: function(response) {
          $('#contentErrorMsg').text(response.responseJSON.errors.name);
        },
      });
    });

    $('#UpdateForm').on('submit',function(e){
      e.preventDefault();

      let content = $('#input-update-content').val();

      let note_id = $('#updateButton').val();
      var url = "/admin/note/:note_id/";
      url = url.replace(':note_id', note_id);

      $.ajax({
        url: url,
        type:"PUT",
        data:{
          "_token": "{{ csrf_token() }}",
          content:content,
        },
        success:function(response){
          window.location.reload();
          $('#editNoteModal').modal('hide');
        },
        error: function(response) {
          $('#contentErrorMsg').text(response.responseJSON.errors.name);
        },
      });
    });

    $(document).on("click", "#edit_note", function(e) {
      e.preventDefault();

      let note_id = $(this).val();
      var url = "{{ URL('/admin/note/:note_id/edit/')}}";
      url = url.replace(':note_id',note_id);

      $.ajax({
        url: url,
        type:"GET",
        success:function(response){
          let data = JSON.parse(response);
          $('#input-update-content').val(data["content"]);
          $('#updateButton').val(note_id);
        },
      })
    });
  </script>
  @endsection