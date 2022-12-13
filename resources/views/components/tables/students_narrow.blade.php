@props([
'students'
])
<x-tables.tables-style />

<div class="table-container hide-wide">
    <table>
        <thead>
        <tr>
            <td colspan="3" style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <x-buttons.add href="/user/students/add" />

            </td>
            <td style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <x-buttons.upload href="/user/students/upload/" />
            </td>
        </tr>
        <tr>
            <th>###</th>
            <th>Name</th>
            <th>Grade</th>
            <th class="" style="color: transparent;">
                Edit<br />
                Remove
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($students AS $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->fullNameAlpha }}</td>
                <td class="text-center">{{ $student->grade }}</td>
                <td class="text-center">
                    <x-buttons.edit href='/user/students/edit/{{ $student->id }}'/><br />
                    <x-buttons.remove href='/user/students/remove/{{ $student->id }}' />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    No students found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
