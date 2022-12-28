<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ensemble') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ $event->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.accepteds active="ensembles" :user="$user" />

    {{-- PAGE CONTENT --}}
    <section class="border border-blue-800 rounded p-4 mx-6 mb-6">
        <h1 class="mb-2 text-lg font-bold"><i>{{ $ensemble->ensemble_name }}</i> of {{ $school->school_name }}</h1>

        {{-- SUCCESS MESSAGE --}}
        @if($message = Session::get('success'))
            <x-messages.success message="{{ $message }}" />
        @endif

        {{-- ERROR ALERT --}}
        @if($errors->any())
            <x-messages.error message="Errors found; see below." />
        @endif

        {{-- ENSEMBLE TABS --}}
        <div>
            <x-tabs.ensemble action="{{ $action }}" :ensemble="$ensemble" />
        </div>

        {{-- EDIT FORM --}}
        <div>
            @if($action === 'descr')
                <x-forms.accepteds.ensembles.description :ensemble="$ensemble"/>
                {{-- INTRO REMOVED PER HACHEY 28-DEC-2022 EMAIL --}}
                {{--
                    @elseif($action === 'intro')
                        <x-forms.accepteds.ensembles.introduction />
                --}}
            @elseif($action === 'rep')
                <x-forms.accepteds.ensembles.repertoire />
            @else
                <x-forms.accepteds.ensembles.setup />
            @endif
        </div>

    </section>

</x-app-layout>
