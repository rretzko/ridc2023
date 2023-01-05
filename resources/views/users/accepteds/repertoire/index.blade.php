<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Repertoire') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS PAGE HEADER--}}
    <x-headers.page_header date="{{ $event->eventDateDMdY }}"/>

    {{-- NAVIGATION --}}
    <x-navs.accepteds active="ensembles" :user="$user" />

    {{-- PAGE CONTENT --}}
    <section class="border border-blue-800 rounded p-4 mx-6 mb-6">
        <h1 class="mb-2 text-lg font-bold">Repertoire for <i>{{ $ensemble->ensemble_name }}</i> from: {{ $school->school_name }}</h1>

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

        {{-- TABS --}}
        <x-tabs.ensemble action="rep" :ensemble="$ensemble" />

        {{-- REPERTOIRETABLES FOR NARROW AND WIDE VIEWPORTS --}}
        <div>
            <x-tables.repertoire.repertoire_narrow :ensembles="$ensembles" :ensemble="$ensemble" />
        </div>

        <div>
            <x-tables.repertoire.repertoire_wide :ensembles="$ensembles" :ensemble="$ensemble"/>
        </div>

    </section>

</x-app-layout>
