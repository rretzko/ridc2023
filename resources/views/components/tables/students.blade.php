@props([
'students'
])
<x-tables.tables-style />

<div class="table-container">
    <table>
        <thead>
        <tr>
            <td colspan="5" style="text-align: right;border: 0; border-bottom: 1px solid black;">
                <a href="{{ route('users.accepteds.students.create') }}" colspan="5"
                   class="text-blue-600 text-sm"
                >
                    <button class="bg-green-200 text-black px-4 rounded-full">
                        Add
                    </button>
                </a>
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
