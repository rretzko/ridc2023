<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ $event->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.accepteds active="application" :user="$user" />

    {{-- PAGE CONTENT --}}
    <section class="border border-blue-800 rounded p-4 mx-6 mb-6">
        <h1 class="mb-2 text-lg font-bold">Ensembles from: {{ $school->school_name }}</h1>

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

        {{-- APPLICATION --}}
        <style>
            data{font-weight: bold;}
            label{width: 12rem; font-size: smaller;}
            hr{border: 1px solid rgba(0,0,0,0.5); margin: 0.5rem 0;}
            .text-group{display: flex; flex-direction: row;}

        </style>
        <div id="application">

            {{-- PROFILE --}}
            <div class="text-group mt-4">
                <label>Name</label>
                <data>{{ $application->userName }}</data>
            </div>
            <div class="text-group">
                <label>Email</label>
                <data>{{ $application->email }}</data>
            </div>
            <div class="text-group">
                <label>Cell</label>
                <data>{{ $application->phoneMobile }}</data>
            </div>
            <div class="text-group">
                <label>Work</label>
                <data>{{ $application->phoneWork }}</data>
            </div>

            <hr />

            {{-- SCHOOL --}}
            <div class="text-group">
                <label>School</label>
                <data>{{ $application->schoolName }}</data>
            </div>
            <div class="text-group">
                <label>Address</label>
                <data>{!! $application->addressBlock !!}</data>
            </div>
            <hr />
            <div class="text-group">
                <label>Attending Adults</label>
                <data>{{ $application->attendingAdults }}</data>
            </div>
            <div class="text-group">
                <label>Attending Students</label>
                <data>{{ $application->attendingStudents }}</data>
            </div>

            <hr />

            {{-- ENSEMBLES --}}
            <div class="text-group">
                <label>Ensembles</label>
                <data>{!! $application->ensemblesBlock !!}</data>
            </div>

        </div>

    </section>

</x-app-layout>
