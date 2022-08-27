<div>

    @foreach($inputs AS $key => $input)
        @if($key === 'geostate_id')
            state = {{ $state_descr }}<br />
        @else
            {{ $key }} = {{ $input }}<br />
        @endif
    @endforeach
</div>
