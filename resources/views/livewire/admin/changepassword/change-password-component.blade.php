<div class="">
    <form wire:submit.prevent="changePassword"
          class="mb-6 flex flex-col" {{-- flex items-start justify-center h-screen p-2 --}}}}
    >
        @csrf

        <div class="flex flex-col">

            <label for="id">Member</label>
            <select wire:model="userid" class="element" autofocus>

                <option value="0" disabled>Select a member</option>

                @foreach($users AS $user)
                    <option value="{{ $user->id }}">{{ $user->nameAlpha }}</option>
                @endforeach

            </select>
        </div>

        <style>
            .element{width: 20rem;}
            @media screen and (min-width: 600px){
                .element{width: 25rem;}
            }
        </style>
        <div class="flex flex-col">

            <label for="id">New Password</label>
            <input wire:model="password" type="text" class="text-black element" style=""/>

        </div>

        <div class="flex flex-col text-left mt-2">

            <input
                class="bg-gray-800 text-white rounded-full shadow-lg my-2"
                type="submit" name="submit" value="Change Password"
            />

        </div>

    </form>

    <div id="message-box">

        @if($changed)
            <div class="bg-green-100 text-green-900 border border-green-900 p-2 element" style="">
                The password for {{ $changedname }} has been changed to: {{ $changed }}
            </div>
        @endif

    </div>
</div>

