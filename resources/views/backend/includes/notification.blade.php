<span class="dropdown-item dropdown-header">{{ sprintf(trans_choice('strings.backend.general.you_have.notifications', $unreadNotificationCount), $unreadNotificationCount) }}</span>
<div class="dropdown-divider"></div>
@foreach($notifications->toArray() as $nK => $nV)
    <a class="dropdown-item" href="{!! route('admin.notification.index') !!}">                    
        <i class="fas fa-exclamation-triangle text-{{$nV['type']}}"></i> {{$nV['message']}}
    </a>
    <div class="dropdown-divider"></div>
@endforeach        

<a class="dropdown-item dropdown-footer" href="{!! route('admin.notification.index') !!}">
{{ trans('strings.backend.general.see_all.notifications') }}</a>
 
