@props(
[
    'application' => $application,
]
)
<x-tables.tables-style />
<table class="border-collapse text-md">
    <thead>
    <tr>
        <th>Primary</th>
        <th>Secondary</th>
        <th>Ensemble(s)</th>
        <th class="sr-only">Remove</th>
    </tr>
    </thead>
    <tbody>
    @forelse(auth()->user()['person']['school']['ensembles'] AS $ensemble)
        <tr>
            <td class="text-center">
                <input type="radio" name="primary" value="{{ $ensemble->id }}"
                    @if($application->primaryensembleid == $ensemble->id) checked @endif
                >
            </td>
            <td class="text-center">
                <input type="checkbox" name="secondaries[]" value="{{ $ensemble->id }}"
                    @if(in_array($ensemble->id, $application->secondaryensembleids)) checked @endif
                >
            </td>
            <td class="text-left" title="Sys.Id: {{ $ensemble->id }}">
                <b>{{ $ensemble->ensemble_name }}</b> <span class="text-sm mt-2 ml-1">({{ $ensemble->category->descr }})</span>
            </td>
            <td class="text-sm text-rose-900">
                <a href="{{ route('user.application.ensemble.destroy',['ensemble' => $ensemble]) }}" >
                    <div style="background-color: white; border-radius: 0.5rem;" >
                        <div style="background-color: rgba(255,0,0,0.1); border-radius: 0.5rem;">
                            <div style="padding: 0.1rem;">Remove</div>
                        </div>
                    </div>
                </a>
            </td>
        </tr>
    @empty
        <tr><td colspan="3" class="text-center">No Ensembles found</td></tr>
    @endforelse
    </tbody>
</table>
@error('primary')
<div class="verror">{{ $message }}</div>
@enderror
@error('secondaries')
<div class="verror">{{ $message }}</div>
@enderror
@error('secondaries.*')
<div class="verror">{{ $message }}</div>
@enderror

