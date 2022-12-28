@props([
'ensemble'
])
<x-tables.tables-style />

<div class="table-container hide-small" style="padding-top: 0.5rem;">
    <table>
        <thead>
        <tr>
            <td colspan="6" style="text-align: right; border: 0; border-bottom: 1px solid black;">
                <x-buttons.add href="href" />
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
        {{-- PLACEHOLDER --}}
        <tr><td colspan="4"></td><td>Edit</td><td>Remove</td></tr>
        {{--
        @foreach($ensembles AS $eventensemble)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $eventensemble->ensemble->ensemble_name }}</td>
                <td class="@if($eventensemble->ensemble->descr) bg-green-100 @else bg-red-100 @endif" >
                    Descr
                </td>
        @empty
            <tr>
                <td colspan="6">No Repertoire Found</td>
            </tr>
        @endforeach
        --}}
{{-- <td class="@if($eventensemble->ensemble->rep) bg-green-100 @else bg-red-100 @endif" >
    Rep
     </td>
 <td class="@if($eventensemble->ensemble->setup) bg-green-100 @else bg-red-100 @endif" >
    Set-Up
 </td>

<td>
    <x-buttons.edit href='/user/ensembles/edit/{{ $eventensemble->ensemble_id }}/descr'/>
</td>
<td>
    <x-buttons.remove href='/user/students/remove/{{ $eventensemble->ensemble_id }}'/>
</td>
</tr>

@empty
<tr>
<td colspan="5">
    No ensembles found
</td>
</tr>
@endforelse
--}}
</tbody>
</table>
</div>
