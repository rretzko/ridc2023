<div>
    <p>Hi Patrick - </p>
    <p>The following was just created on the Contact form from RoxburyInvitational.com:</p>
    <div>
        @foreach($inputs AS $key => $input)
            @if($key === 'geostate_id')
                state = {{ $state_descr }}<br />
            @else
                {{ $key }} = {{ $input }}<br />
            @endif
        @endforeach
    </div>
    <p>
        Best - Rick
    </p>
</div>
