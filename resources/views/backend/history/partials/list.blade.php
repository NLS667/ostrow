<ul class="timeline timeline-simple">
    @each('backend.history.partials.item', $history, 'historyItem')
</ul>

@if ($paginate)
    <div class="float-right">
        {{ $history->links() }}
    </div><!--pull-right-->

    <div class="clearfix"></div>
@endif