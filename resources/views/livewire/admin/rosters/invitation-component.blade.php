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
        .withdraw{background-color: rgba(255,0,0,0.1); color: darkred; border: 1px solid darkred;}
        .withdrew{background-color: darkred; color: pink; border: 1px solid pink;}
    </style>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Invite</th>
            <th>Accept</th>
            <th>Withdraw</th>
        </tr>
        </thead>
        <tbody>
        @forelse($invitations AS $invitation)
            <tr>
                <td style="text-align: left;" title="Sys.Id. {{ $invitation['user']->id }}">
                    <div>{{ $invitation['user']->last.', '.$invitation['user']->first.' '.$invitation['user']->middle }}</div>
                    <div class="text-xs ml-4">{{ $invitation['user']->schools->first()->shortname }}</div>
                </td>
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="invite({{ $invitation['user'] }})"
                            class="{{ $invitation['user']->invitationStatus }}"
                            style="border-radius: 0.25rem; padding: 0 0.25rem;"
                            title = "{{ $invitation['user']->eventInvitationsButtonTitle }}"
                    >
                        {{ ucfirst($invitation['user']->invitationStatus) }}
                    </button>
                </td>
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="accept({{ $invitation['user'] }})"
                            class="{{ $invitation['user']->acceptedStatus }}"
                            style="border-radius: 0.25rem; padding: 0 0.25rem;"
                    >
                        {{ ucfirst($invitation['user']->acceptedStatus) }}
                    </button>
                </td>
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="withdraw({{ $invitation['user'] }})"
                            class="{{ $invitation['user']->withdrawStatus }}"
                            style="border-radius: 0.25rem; padding: 0 0.25rem;">
                        {{ ucfirst($invitation['user']->withdrawStatus) }}
                    </button>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No invitations found</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination links --}}
    <div class="mt-4">
        {{ $invitations->links() }}
    </div>
</div>

