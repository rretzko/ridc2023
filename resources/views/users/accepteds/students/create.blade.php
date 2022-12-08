<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ $event->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.accepteds active="students" :user="$user" />

    {{-- PAGE CONTENT --}}
    <section class="border border-blue-800 rounded p-4 mx-6 mb-6">
        <h1 class="mb-2 text-lg font-bold">Students from: {{ $school->school_name }}</h1>

        {{-- SUCCESS MESSAGE --}}
        @if($message = Session::get('success'))
            <x-messages.success message="{{ $message }}" />
        @endif

        {{-- ERROR ALERT --}}
        @if($errors->any())
            <x-messages.error message="Errors found; see below." />
        @endif

        {{-- STUDENT TABLES FOR NARROW AND WIDE VIEWPORTS --}}
        <div>
            <x-tables.students_narrow :students="$students" />
        </div>

        <div>
            <x-tables.students_wide :students="$students" />
        </div>

        {{-- CREATE FORM --}}
        <div>
            <x-forms.accepteds.add_student :class_ofs="$class_ofs"/>
        </div>

    </section>

</x-app-layout>
