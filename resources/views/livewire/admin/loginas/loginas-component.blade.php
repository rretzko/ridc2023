<div class="">
    <form wire:submit.prevent="logInAs"
        class="mb-6 flex flex-col" {{-- flex items-start justify-center h-screen p-2 --}}}}
    >
        @csrf

        <div class="flex flex-col">

            <label for="id">Member</label>
            <select wire:model="userid" >

                <option value="0" disabled>Select a member</option>

                @foreach($users AS $user)
                    <option value="{{ $user->id }}">{{ $user->nameAlpha }}</option>
                @endforeach

            </select>
        </div>

        <div class="flex flex-col text-left mt-2">

            <input
                class="bg-gray-800 text-white rounded-full shadow-lg my-2"
                type="submit" name="submit" value="Log In As..."
            />

        </div>

    </form>

    <div id="message-box">

        @if($notfound)
            <div class="bg-rose-100 text-rose-900 border border-rose-900 p-2">Please select a member.</div>
        @endif

    </div>
</div>
