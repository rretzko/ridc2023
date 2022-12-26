@props([
'ensembles'
])
<x-tables.tables-style />

<div class="table-container hide-small" style="padding-top: 0.5rem;">
    <table>
        <thead>
        {{-- POST ACCEPTANCE, ENSEMBLES CANNOT BE ADDED OR UPLOADED BY THE DIRECTOR --}}
        <!--
        <tr>
            <td colspan="7" style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <x-buttons.add href="/user/ensembles/add" />
            </td>
            <td style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <x-buttons.upload href="/user/ensembles/upload" />
            </td>
        </tr>
        -->
        <tr>
            <th>###</th>
            <th>Name</th>
            <th>Descr</th>
            <th>Intro</th>
            <th>Rep</th>
            <th>Set-Up</th>
            <th class="" style="color: transparent;">Edit</th>
            <th class="" style="border-right: 1px solid black; color: transparent">Remove</th>
        </tr>
        </thead>
        <tbody>
        @forelse($ensembles AS $eventensemble)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $eventensemble->ensemble->ensemble_name }}</td>
                <td class="@if($eventensemble->ensemble->descr) bg-green-100 @else bg-red-100 @endif" >
                    Descr
                </td>
                <td class="@if($eventensemble->ensemble->intro) bg-green-100 @else bg-red-100 @endif" >
                    Intro
                </td>
                <td class="@if($eventensemble->ensemble->rep) bg-green-100 @else bg-red-100 @endif" >
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
        </tbody>
    </table>
</div>
