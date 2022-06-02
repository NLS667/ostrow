<li class="timeline-inverted">
	<div class="timeline-badge {{ $historyItem->class }}">
		<i class="material-icons">{{ $historyItem->icon }}</i>
	</div>
    <div class="timeline-panel">
    	<div class="timeline-heading">
    		<span class="badge badge-pill badge-{{$historyItem->class}}">{{ $historyItem->created_at->diffForHumans() }}</span>&nbsp;<strong>{{ $historyItem->user->name }}</strong> {!! history()->renderDescription($historyItem->text, $historyItem->assets) !!}
    	</div>
    </div><!--timeline-item-->
</li>