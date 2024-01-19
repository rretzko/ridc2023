@props(
[
    'soloists' => $soloists,
])
<x-tables.tables-style />
<table class="border-collapse text-md">
    <thead>
    <tr>
        <th>Soloist</th>
        <th>Type</th>
        <th>Title</th>
        <th>Composer</th>
        <th class="sr-only">Edit</th>
        <th class="sr-only">Remove</th>
    </tr>
    </thead>
    <tbody>
    @forelse($soloists AS $soloist)
        <tr>
            <td class="text-center" title="Sys.Id: {{ $soloist['id'] }}">
                {{ $soloist['fullNameAlpha'] }}
            </td>
            <td class="text-center">
                {{ $soloist['soloistTypeDescr'] }}
            </td>
            <td class="text-left" >
                {{ $soloist['title'] }}
            </td>
            <td class="text-left" >
                {{ $soloist['composer'] }}
            </td>
            <td class="">
                <a href="{{ route('users.accepteds.soloists.edit',['soloist' => $soloist['id']]) }}" >
                    <button class="text-sm bg-indigo-900 text-white px-2 rounded-full" >
                        Edit
                    </button>
                </a>
            </td>
            <td class="">
                <a href="{{ route('users.accepteds.soloists.destroy',['soloist' => $soloist['id']]) }}" >
                    <button class="text-sm bg-red-600 text-white px-2 rounded-full">
                        Remove
                    </button>

                </a>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">No Soloist found</td></tr>
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

