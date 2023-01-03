@props([
    'ensemble',
    'ensembles'
])

<x-tables.tables-style />

<div class="table-container hide-small" style="padding-top: 0.5rem;">
    <table>
        <thead>
        <tr>
            <td colspan="6" style="text-align: right; border: 0; border-bottom: 1px solid black;">
                <x-buttons.add href="{{ route('users.repertoire.create', ['ensemble' => $ensemble]) }}" />
            </td>
        </tr>
        <tr>
            <th>###</th>
            <th>Title</th>
            <th>Artists</th>
            <th>Time</th>
            <th class="" style="color: transparent;">Edit</th>
            <th class="" style="border-right: 1px solid black; color: transparent">Remove</th>
        </tr>
        </thead>
        <tbody>

        @forelse($ensemble['repertoire'] AS $repertoire)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $repertoire->title }}</td>
                <td>{{ $repertoire->artistsCsv() }}</td>
                <td>{{ $repertoire->durationInMinutesSeconds() }}</td>
                <td>Edit</td>
                <td>Remove</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No Repertoire Found</td>
            </tr>
        @endforelse

</tbody>
</table>
</div>
