<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Judging') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ $event->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.accepteds active="judging" :user="$user" />

    {{-- PAGE CONTENT --}}
    <section class="border border-blue-800 rounded p-4 mx-6 mb-6">
        <h1 class="mb-2 text-lg font-bold">Judge Recordings</h1>

        {{-- SUCCESS MESSAGE --}}
        @if($message = Session::get('success'))
            <div class="w-1/3">
                <x-messages.success message="{{ $message }}"/>
            </div>
        @endif

        {{-- FAILURE MESSAGE --}}
        @if($message = Session::get('failure'))
            <div>
                <x-messages.error message="{{ $message }}"/>
            </div>
        @endif

        {{-- ERROR ALERT --}}
        @if($errors->any())
            <div>
                <x-messages.error message="Errors found; see below."/>
            </div>
        @endif

        {{-- JUDGES RECORDINGS --}}
        <div>
            <style>
                table{border-collapse: collapse; width: auto;}
                td,th{border: 1px solid black; padding: 0 0.5rem;}
            </style>
            <table class="mx-auto">
                <thead>
                <tr>
                    <th>###</th>
                    <th>Event</th>
                    <th>Portion</th>
                    <th>Ensemble</th>
                    <th>Adjudicator</th>
                    <th>Part</th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                @forelse($fileUploads AS $file)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $file->eventName }}</td>
                        <td>{{ $file->portion ? 'Daytime' : 'Showcase' }}</td>
                        <td>{{ $file->ensembleName }}</td>
                        <td>{{ $file->adjudicatorName }}</td>
                        <td class="text-center">{{ $file->partial }}</td>
                        <td>{!! $file->mp3Player !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No Recordings found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </section>

</x-app-layout>
