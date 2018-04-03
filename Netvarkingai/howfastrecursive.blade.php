@if ($recursive_timer > $iterative_timer)
    <span class="badge badge-danger shadow pull-right">{{ $recursive_timer . " ms"}}</span>  
@else
    <span class="badge badge-success shadow pull-right">{{ $recursive_timer . " ms"}}</span>
@endif