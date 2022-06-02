<li class="timeline-inverted">
	<div class="timeline-badge {{ $historyItem->class }}">
		<i class="material-icons">{{ $historyItem->icon }}</i>
	</div>
    <div class="timeline-panel">
    	<div class="timeline-body">
    		<span class="badge badge-pill badge-{{$historyItem->class}}">{{ $historyItem->created_at->diffForHumans() }}</span>
    		<p style="display:inline; padding: 0 5px; position:relative; top: 1px;"><strong>{{ $historyItem->user->name }}</strong> {!! history()->renderDescription($historyItem->text, $historyItem->assets) !!}</p>
    	</div>
    </div><!--timeline-item-->
</li>