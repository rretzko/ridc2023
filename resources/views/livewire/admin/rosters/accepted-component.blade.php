<div>
    {{-- SUCCESS MESSAGE --}}
    @if(session()->has('success'))
        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;font-size: 0.8rem; margin: auto; margin-top: 1rem; padding: 0 0.5rem; ">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="flex flex-col mt-1">
        <form wire:submit.prevent="submitEnsembleCount" class="flex flex-col mx-auto p-2 rounded border border-gray-600"
              style="background-color: rgba(0,0,0,0.1); width: 600px;"
        >
            <header class="font-bold mb-6">Edit Ensemble Count</header>
            <div class="">
                <div class="flex flex-row">
                    <label class="mr-2">Teacher</label>
                    <div class="font-bold">{{ $this->teacherName }}</div>
                </div>
                <div class="flex flex-row">
                    <label class="mr-2">Ensemble Count</label>
                    <div>
                        <select wire:model="ensembleCount">
                            @for($i=1; $i < 10; $i++)
                                <option value="{{ $i }}">
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div>
                    <label></label>
                    <div>
                        <input style="background-color: grey; border: 1px solid black; border-radius: 0.5rem; color: @if($this->teacherName) white @else lightgrey @endif ; padding: 0 0.25rem;"
                               @if(! $this->teacherName) DISABLED @endif
                               type="submit"
                               name="submit"
                               value="Update"
                        />
                    </div>
                </div>
            </div>

        </form>
        <div>
            @if(strlen($this->success))
                <div class="text-center" style="font-size: 1rem; background-color: rgba(0,255,0,0.1); color: darkgreen; padding:0 0.25rem; margin: auto; margin-top: 0.5rem; width: 600px;">
                    {{ $this->success }}
                </div>
            @endif
        </div>
    </div>

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
            <th>###</th>
            <th>Name</th>
            <th>Accept</th>
            <th title="Ensemble count">Ens #</th>
            <th class="sr-only">Edit</th>
            <th class="sr-only">Withdraw</th>
        </tr>
        </thead>
        <tbody>
        @forelse($invitations AS $invitation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;" title="Sys.Id. {{ $invitation['user']->id }}">
                    <div>{{ $invitation['user']->last.', '.$invitation['user']->first.' '.$invitation['user']->middle }}</div>
                    <div class="text-xs ml-4">{!! ($invitation['user']['person']['school']) ? $invitation['user']['person']['school']->shortname : '<span style="color:red">No school found</span>' !!}</div>
                </td>
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="accept({{ $invitation['user'] }})"
                            class="{{ $invitation['user']->acceptedStatus }}"
                            style="border-radius: 0.25rem; padding: 0 0.25rem;"
                    >
                        {{ ucfirst($invitation['user']->acceptedStatus) }}
                    </button>
                </td>
                <td>
                    {{ $invitation->ensemble_count }}
                </td>
                <td style="padding: 0.25rem; font-size: small;">
                    <button wire:click="edit({{ $invitation['user'] }})"
                            class=""
                            style="background-color: lightgray; border: 1px solid black; border-radius: 0.25rem; padding: 0 0.25rem;">
                        Edit
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
            <tr><td colspan="4">No accepteds found</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination links --}}
    <div class="mt-4">
        {{ $invitations->links() }}
    </div>

</div>

