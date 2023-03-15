<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recordings') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <x-headers.event_logistics />

    <div class="py-2">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- ADMIN MENU --}}
                    <x-navs.admin_menu :admin_active=$admin_active />

                </div>

                {{-- EVENT SELECTION --}}
                <div class="flex flex-col ml-20 mt-4">
                    <form method="post" action="{{ route('admin.recordings.show') }}" >

                        @csrf

                        <div class="flex flex-row space-x-4">
                            <label>Select Event</label>
                            <select name="event_id">
                                @foreach($events AS $event)
                                    <option value="{{ $event->id }}"

                                        @selected($eventId == $event->id)
                                    >
                                        {{ $event->subtitle }}
                                    </option>
                                @endforeach
                            </select>
                            <input class="bg-gray-300 border border-black px-2 rounded" type="submit" name="submit" value="Submit" />
                        </div>

                    </form>
                </div>

                {{-- RECORDINGS TABLE --}}
                <style>
                    table{border-collapse: collapse; width: 90%; margin:1rem auto;}
                    td,th{border: 1px solid black; padding: 0 0.25rem;}
                </style>
                <table>
                    <thead>
                    <tr>
                        <th>###</th>
                        <th>School</th>
                        <th>Ensemble</th>
                        <th>Adjudicator</th>
                        <th>Part</th>
                        <th>Recording</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recordings AS $recording)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $recording->schoolName }}</td>
                            <td>{{ $recording->ensembleName }}</td>
                            <td>{{ $recording->adjudicatorName }}</td>
                            <td class="text-center">{{ $recording->partial }}</td>
                            <td>{!! $recording->mp3Player !!}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No Recordings Found</td></tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
