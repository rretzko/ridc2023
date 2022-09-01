<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Main Menu') }}
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

                <div>
                    @if(session('success'))
                        <div class="m-6 bg-green-100 text-green-800 border-green-800 px-2">
                            {!! session('success') !!}
                        </div>
                    @endif
                </div>

                <div class="px-6 py-2">
                    <section class="border border-gray-400 p-2 rounded mb-4">
                        <x-forms.admin-events-store />
                    </section>

                    <section>
                        <x-tables.admin-events-table :events=$events />
                    </section>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
