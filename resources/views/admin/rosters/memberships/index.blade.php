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

                    {{-- TABLE --}}
                    <style>
                        table{border-collapse: collapse; margin: auto;  margin-top: 1rem;}
                        td,th{border: 1px solid black; padding: 0 0.25rem; text-align: center;}
                        .accept{background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;}
                        .accepted{background-color: darkgreen; color: lightgreen; border: 1px solid rgba(0,255,0,0.1);}
                        .invite{background-color: lemonchiffon; color: brown; border: 1px solid darkgoldenrod; }
                        .invited{background-color: brown; color: lemonchiffon; border: 1px solid darkgoldenrod; }
                    </style>
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Invite</th>
                            <th>Accept</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users AS $user)
                            <tr>
                                <td style="text-align: left;">
                                    <div>{{ $user->last.', '.$user->first.' '.$user->middle }}</div>
                                    <div class="text-xs ml-4">{{ $user->schools->first()->shortname }}</div>
                                </td>
                                <td style="padding: 0.25rem; font-size: small;">
                                    <a href="{{ route('admin.invite',['user' => $user]) }}">
                                        <button class="@if($user->eventInvitationsCount) invited @else invite @endif"
                                                style="border-radius: 0.25rem; padding: 0 0.25rem;"
                                                title = "{{ $user->eventInvitationsButtonTitle }}"
                                        >
                                            @if($user->eventInvitationsCount) Invited @else Invite @endif
                                        </button>
                                    </a>
                                </td>
                                <td style="padding: 0.25rem; font-size: small;">
                                    <a href="{{ route('admin.accept', ['user' => $user]) }}">
                                        <button class="@if($user->accepted) accepted @else accept @endif"
                                            style="border-radius: 0.25rem; padding: 0 0.25rem;"
                                        >
                                            @if($user->accepted) Accepted @else Accept @endif
                                        </button>
                                    </a>
                                </td>
                                <td style="padding: 0.25rem; font-size: small;">
                                    <a href="">
                                        <button style="background-color: rgba(255,0,0,0.1); color: darkred; border: 1px solid darkred; border-radius: 0.25rem; padding: 0 0.25rem;">
                                            Remove
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td>No members found</td></tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination links --}}
                    <div class="mt-4>
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
