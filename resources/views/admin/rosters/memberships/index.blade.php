<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Main Menu') }}
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

                    {{-- ROSTERS MENU --}}
                    <x-navs.roster_menu :roster_active=$roster_active />

                    {{-- Instructions --}}
                    <x-instructions.instructions  >
                        <x-instructions.admin.membership />
                    </x-instructions.instructions>

                    {{-- SUCCESS MESSAGE --}}
                    @if(session()->has('success'))
                        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;font-size: 0.8rem; margin: auto; margin-top: 1rem; padding: 0 0.5rem; ">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                </div>

                {{-- LIVEWIRE --}}
                @livewire('admin.rosters.membership')

            </div>
        </div>
    </div>
</x-app-layout>
