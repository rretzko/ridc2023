<div>
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
        .pending{background-color: lightgray; color: black; border: 1px solid darkgrey; font-size: small; }
    </style>

    <table>
        <thead>
        <tr>
            <td colspan="5" class="py-2 px-2">
                <a href="{{ route('admin.rosters.membership.add') }}" class="border border-green-800 text-green-800 rounded-full px-2 bg-green-100">
                    Add New Member
                </a>
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <th>Invite</th>
            <th>Applied</th>
            <th>Accept</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users AS $user)
            <tr>
                {{-- NAME --}}
                <td style="text-align: left;" title="Sys.Id. {{ $user->id }}">
                    <div>
                        <a href="{{ route('admin.rosters.membership.edit', ['user' => $user]) }}" class="text-blue-600">
                            {{ $user->last.', '.$user->first.' '.$user->middle }}
                        </a>
                    </div>
                    <div class="text-xs ml-4">{!!  $user->person && $user->person->school ? $user->person->school->shortname : '<span style="color:red">No school found</span>' !!}</div>
                </td>

                {{-- INVITE --}}
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="invite({{ $user }})"
                        class="{{ $user->invitationStatus }}"
                            style="border-radius: 0.25rem; padding: 0 0.25rem;"
                            title = "{{ $user->eventInvitationsButtonTitle }}"
                    >
                        {{ ucfirst($user->invitationStatus) }}
                    </button>
                </td>

                {{-- APPLIED --}}
                <td style="padding: 0.25rem; font-size: small;">
                    @if($user->applicationStatus)
                        <button wire:click="applied({{ $user }})"
                                class=""
                                style="background-color: rgba(0,0,255,.1); border: 1px solid rgba(0,0,255,0.5); border-radius: 0.25rem; padding: 0 0.25rem;"
                                title = "Applied"
                        >
                            Applied
                        </button>
                    @endif
                </td>

                {{-- ACCEPT --}}
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="accept({{ $user }})"
                        class="{{ $user->acceptedStatus }}"
                        style="border-radius: 0.25rem; padding: 0 0.25rem;"
                    >
                        {{ ucfirst($user->acceptedStatus) }}
                    </button>
                </td>

                {{-- REMOVE --}}
                <td style="padding: 0.25rem; font-size: small;">
                        <button wire:click="remove({{ $user }})"
                            style="background-color: rgba(255,0,0,0.1); color: darkred; border: 1px solid darkred; border-radius: 0.25rem; padding: 0 0.25rem;">
                            Remove
                        </button>
                </td>
            </tr>
        @empty
            <tr><td>No members found</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination links --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
