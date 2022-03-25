@extends ('backend.layouts.app', ['activePage' => 'notifications', 'titlePage' => 'Powiadomienia'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Notifications</h4>
                    </div><!-- /.box-header -->
                    <div class="card-body">
                        <ul class="timeline timeline-simple notification-list">
                            @foreach($notifications as $notification)
                            @php
                            $currentTime     = \carbon\Carbon::now();
                            $notificationTime = $notification->created_at;
                            @endphp 
                            <li class="timeline-inverted">
                                <div class="timeline-badge info">
                                    <i class="material-icons">schedule</i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-body">
                                        {{$notification->message}}
                                    </div>
                                    <div class="timeline-footer">
                                        <span class="badge badge-pill badge-default">{{$notificationTime->diffForHumans($currentTime)}}</span>
                                    </div>
                                </div><!--timeline-panel-->
                            </li>
                            @endforeach
                        </ul><!--timeline-->
                    </div><!-- /.card-body -->
                </div><!--card-->
            </div>
        </div>
    </div>
</div>
@endsection