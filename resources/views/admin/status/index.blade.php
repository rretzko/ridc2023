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

                {{-- DOWNLOAD ICON --}}
                <div style="color: blue; display: flex; justify-content: end; margin-right: 2rem; margin-top: 1rem;">
                    <a href="{{ route('admin.status.download') }}" title="Download to csv file">
                        <x-heroicons.table-cells/>
                    </a>
                </div>

                {{-- TABLE --}}
                <div>
                    {!! $table !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
