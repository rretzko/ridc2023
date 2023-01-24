@props([
    'personnel' => $personnel,
    'school' => $school,
])

<x-forms.stylesheet />

<form method="post"
      class="border md:border-transparent md:border-l-black md:mx-4 md:px-4"
      action="{{ route('users.accepteds.personnel.update', ['school' => $school]) }}"
>

    @csrf

    <input type="hidden" name="school_id" value="{{ $school->id }}" />

    <h3 class="font-bold">Personnel Information</h3>

    {{-- ARRIVAL TIME --}}
    <div class="input-group">
        <label for="arrival_time">Arrival Time</label>

        <input
            class="@error('arrival_time') bg-red-50 @enderror long-text"
            type="text"
            name="arrival_time"
            value="{{ $personnel->arrival_time }}"
            placeholder="8:30 AM"
            required
        />
        {{-- ERRORS: Arrival Time --}}
        @error('arrival_time')
            <x-messages.error message="{{ $message }}" />
        @enderror
    </div>

    {{-- ACCOMMODATION --}}
    <div class="input-group">

        <label for="accommodation">Accommodation</label>
        <input
            class="@error('accommodation') bg-red-50 @enderror long-text"
            type="text"
            name="accommodation"
            value="{{ $personnel->accommodation }}"
            placeholder=""
        />
        {{-- ERRORS: Accommodation --}}
        @error('accommodation')
        <x-messages.error message="{{ $message }}" />
        @enderror
    </div>

    {{-- CHAPERONES --}}
    <div class="input-group">

        <label for="chaperone_1">Chaperones</label>
        <div class="flex flex-col">
            <input
                class="@error('chaperone[0]') bg-red-50 @enderror long-text mb-1"
                type="text"
                name="chaperones[]"
                value="{{ $personnel->chaperone_1 }}"
                placeholder="Chaperone 1"
            />
            {{-- ERRORS: Chaperone_1 --}}
            @error('chaperone[0]')
            <x-messages.error message="{{ $message }}"/>
            @enderror

            <input
                class="@error('chaperone[1]') bg-red-50 @enderror long-text mb-1"
                type="text"
                name="chaperones[]"
                value="{{ $personnel->chaperone_2 }}"
                placeholder="Chaperone 2"
            />
            {{-- ERRORS: Chaperone_2 --}}
            @error('chaperone[1]')
            <x-messages.error message="{{ $message }}"/>
            @enderror

            <input
                class="@error('chaperone[2]]') bg-red-50 @enderror long-text"
                type="text"
                name="chaperones[]"
                value="{{ $personnel->chaperone_3 }}"
                placeholder="Chaperone 3"
            />
            {{-- ERRORS: Chaperone_3 --}}
            @error('chaperone[2]')
            <x-messages.error message="{{ $message }}"/>
            @enderror
        </div>
    </div>

    {{-- TICKETS --}}
    <div class="input-group">

        <label for="tickets">Pre-Event Tickets @ $10/each</label>
        <select name="tickets" class="short-text">
            <option value="0">0</option>
            @for($i=1; $i<51; $i++)
                <option value="{{ $i }}"
                    @if($personnel->tickets == $i) selected @endif
                >
                    {{ $i }}
                </option>
            @endfor
        </select>

        {{-- ERRORS: Accommodation --}}
        @error('tickets')
        <x-messages.error message="{{ $message }}" />
        @enderror
    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
