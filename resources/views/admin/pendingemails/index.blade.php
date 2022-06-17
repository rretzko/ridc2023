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
                    <x-navs.admin_menu  />

                    {{-- ROSTERS MENU --}}
                    <!-- <x-navs.roster_menu  /> -->

                    {{-- Instructions --}}
                    <!--
                    <x-instructions.instructions  >
                        <x-instructions.admin.membership />
                    </x-instructions.instructions>
                    -->

                    {{-- SUCCESS MESSAGE --}}
                    @if(session()->has('success'))
                        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;font-size: 0.8rem; margin: auto; margin-top: 1rem; padding: 0 0.5rem; ">
                            {!!  session()->get('success') !!}
                        </div>
                    @endif

                    {{-- TABLE --}}
                    <style>
                        table{border-collapse: collapse; margin: auto;  margin-top: 1rem;}
                        td,th{border: 1px solid black; padding: 0 0.25rem; text-align: center;}
                        .invite{background-color: lemonchiffon; color: brown; border: 1px solid darkgoldenrod; }
                        .invited{background-color: brown; color: lemonchiffon; border: 1px solid darkgoldenrod; }
                    </style>
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>
                                <a href="{{ route('admin.pendingemails.update') }}">
                                    <button style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen; border-radius: 0.25rem; font-size: 1rem; padding: 0 0.25rem; margin: 0.25rem;">
                                        Send All
                                    </button>
                                </a>
                            </th>
                            <th
                                <a href="">
                                    <button style="background-color: rgba(255,0,0,0.1); color: darkred; border: 1px solid darkred; border-radius: 0.25rem; font-size: 1rem; padding: 0 0.25rem; margin: 0.25rem;">
                                        Remove All
                                    </button>
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($pending AS $pendingemail)
                            <tr>
                                <td style="text-align: left;">
                                    {{ $pendingemail['user']->name }}
                                </td>
                                <td>
                                    {{ $pendingemail['pendingemailtype']->descr }}
                                </td>
                                <td style="padding: 0.25rem; font-size: small;">
                                    <a href="{{ route('admin.pendingemails.update', $pendingemail) }}">
                                        <button style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen; border-radius: 0.25rem; padding: 0 0.25rem;">
                                            Send
                                        </button>
                                    </a>
                                </td>
                                <td style="padding: 0.25rem; font-size: small;">
                                    <a href="{{ route('admin.pendingemails.remove', $pendingemail) }}">
                                        <button style="background-color: rgba(255,0,0,0.1); color: darkred; border: 1px solid darkred; border-radius: 0.25rem; padding: 0 0.25rem;">
                                            Remove
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No pending emails found</td></tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
