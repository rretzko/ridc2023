<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ \App\Models\CurrentEvent::currentEvent()->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.application />

    <section class="border border-blue-800 rounded p-4 mx-6 mb-6">
        <h1 class="mb-2 text-lg font-bold">Festival Application Form</h1>

        <x-forms.application :application="$application"/>

    </section>

</x-app-layout>
