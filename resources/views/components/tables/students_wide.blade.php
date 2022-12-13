@props([
'students'
])
<x-tables.tables-style />

<div class="table-container hide-small">
    <table>
        <thead>
        <tr>
            <td colspan="4" style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <x-buttons.add href="/user/students/add" />
            </td>
            <td style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <x-buttons.upload href="/user/students/upload" />
            </td>
        </tr>
        <tr>
            <th>###</th>
            <th>Name</th>
            <th>Grade</th>
            <th class="" style="color: transparent;">Edit</th>
            <th class="" style="border-right: 1px solid black; color: transparent">Remove</th>
        </tr>
        </thead>
        <tbody>
        @forelse($students AS $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->fullNameAlpha }}</td>
                <td class="text-center">{{ $student->grade }}</td>
                <td>
                    <x-buttons.edit href='/user/students/edit/{{ $student->id }}'/>
                </td>
                <td>
                    <x-buttons.remove href='/user/students/remove/{{ $student->id }}'/>
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
