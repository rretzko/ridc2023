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

                {{-- RECORDINGS TABLE --}}
                <style>
                    table{border-collapse: collapse; width: 90%; margin:1rem auto;}
                    td,th{border: 1px solid black;}
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
