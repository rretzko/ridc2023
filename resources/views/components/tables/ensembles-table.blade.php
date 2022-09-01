<x-tables.tables-style />
<table class="border-collapse text-md">
    <thead>
    <tr>
        <th>Primary</th>
        <th>Secondary</th>
        <th>Ensemble(s)</th>
    </tr>
    </thead>
    <tbody>
    @forelse(auth()->user()['person']['school']['ensembles'] AS $ensemble)
        <tr>
            <td class="text-center">
                <input type="radio" name="primary" value="{{ $ensemble->id }}">
            </td>
            <td class="text-center">
                <input type="checkbox" name="secondaries[]" value="{{ $ensemble->id }}">
            </td>
            <td class="text-left">
                <b>{{ $ensemble->ensemble_name }}</b> <span class="text-sm mt-2 ml-1">({{ $ensemble->category->descr }})</span>
            </td>
        </tr>
    @empty
        <tr><td colspan="3" class="text-center">No Ensembles found</td></tr>
    @endforelse
    </tbody>
</table>
