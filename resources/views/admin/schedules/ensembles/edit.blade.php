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

                {{-- ENSEMBLES TABLE BUTTONS --}}
                <div class="flex flex-row justify-end space-x-2 mr-12">

                    {{-- the current view
                    <div class="">
                        <a href="{{ route('admin.schedules.ensembles.edit') }}">
                            <button class="bg-indigo-200 rounded-full px-2 text-sm">
                                Update Schedule
                            </button>
                        </a>
                    </div>
                    --}}

                    <div class="">
                        <a href="{{ route('admin.schedules.ensembles.show') }}">
                            <button class="bg-yellow-300 rounded-full px-2 text-sm">
                                Daytime Schedule
                            </button>
                        </a>
                    </div>

                    <div class="">
                        <a href="{{ route('admin.schedules.ensembles.csv') }}">
                            <button class="bg-fuchsia-300 rounded-full px-2 text-sm">
                                Download Csv
                            </button>
                        </a>
                    </div>

                </div>

                {{-- ENSEMBLES FORM AND TABLE --}}
                @livewire('admin.schedules.ensembles.ensemble-component')

            </div>
        </div>
    </div>
</x-app-layout>
