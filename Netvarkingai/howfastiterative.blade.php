@if ($iterative_timer > $recursive_timer)
    <span class="badge badge-danger shadow pull-right">{{ $iterative_timer . " ms" }}</span>
@else
    <span class="badge badge-success shadow pull-right">{{ $iterative_timer . " ms" }}</span>
@endif