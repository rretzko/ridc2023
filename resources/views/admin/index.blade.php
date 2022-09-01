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

                <div id="utility_actions" class="flex items-start justify-center h-screen p-2">
                    <ol class="ml-4 list-decimal">
                        <li>
                            <a href="{{ route('admin.loginAs') }}" class="text-anchor-blue">
                                Log In As...
                            </a>
                        </li>
                        <li class="text-anchor-blue">
                            <a href="{{ route('admin.changePassword') }}" class="text-anchor-blue">
                                Change Password
                            </a>
                        </li>
                        <li class="text-anchor-blue">
                            <a href="{{ route('admin.about') }}" class="text-anchor-blue">
                                Update 'About' sections
                            </a>
                        </li>
                        <li class="text-anchor-blue">
                            <a href="{{ route('admin.events') }}" class="text-anchor-blue">
                                Event Management
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
