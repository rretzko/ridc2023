<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ensembles Schedule') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <x-headers.event_logistics />

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- ADMIN MENU --}}
                    <x-navs.admin_menu :admin_active="$admin_active"/>

                </div>

                {{-- ENSEMBLES TABLE --}}
                <div class="my-2 flex justify-end mr-24">
                    <a href="{{ route('admin.schedules.ensembles.edit') }}">
                        <button class="bg-indigo-200 rounded-full px-2 text-sm">
                            Update Schedule
                        </button>
                    </a>
                </div>
                <div class="">
                    {!! $table !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>