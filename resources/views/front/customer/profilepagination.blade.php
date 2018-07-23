<p class="amount">Items {!!($items->currentPage() * $items->perPage()) - ($items->perPage() -1)!!} to {!! $items->currentPage() * $items->perPage() < $items->total() ? $items->currentPage() * $items->perPage() : $items->total() !!} of {!!$items->total()!!}</p>

@if($items->render() != '')
<div class="pager">
    <div class="pages gen-direction-arrows1">
        {!! str_replace('/?', '?',$items->render()) !!}
    </div>
</div>
@endif