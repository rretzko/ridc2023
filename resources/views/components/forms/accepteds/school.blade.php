@props([
'colors',
'geostates',
'school',
])

<x-forms.stylesheet />

<form method="post" action="{{ route('users.accepteds.schools.update', ['school' => $school]) }}">

    @csrf

    <div class="input-group">
        <label for="school_name">Name</label>
        <div class="col2row ">

            {{-- SCHOOL NAME --}}
            <input
                class="@error('school_name') bg-red-50 @enderror long-text"
                type="text"
                name="school_name"
                value="{{ $school->school_name }}"
                placeholder="School name"
                required
            />
            {{-- ERRORS: School Name --}}
            @error('school_name')
                <x-messages.error message="{{ $message }}" />
            @enderror
        </div>
    </div>

    {{-- ADDRESSES 1 and 2--}}
    <div class="input-group">
        <label for="address_1">Address</label>
        <input
            class=" @error('address_1') bg-red-50 @enderror long-text mb-1"
            type="text"
            name="address_1"
            value="{{ $school->address_1 }}"
            required
        />
        @error('address_1')
            <x-messages.error message="{{ $message }}" />
        @enderror

        <input
            class=" @error('address_2') bg-red-50 @enderror long-text"
            type="text"
            name="address_2"
            value="{{ $school->address_2 }}"
            placeholder="Address 2"
        />
        @error('address_2')
            <x-messages.error message="{{ $message }}" />
        @enderror

    </div>

    {{-- CITY, STATE, ZIP --}}
    <div class="input-group">
        <label for="city">City, State, Zip</label>
        <div class="col2row">
            <div>
                {{-- CITY --}}
                <input
                    class=" @error('city') bg-red-50 @enderror long-text mb-1"
                    type="text"
                    name="city"
                    value="{{ $school->city }}"
                    required
                />
                @error('city')
                    <x-messages.error message="{{ $message }}" />
                @enderror
            </div>

            {{-- STATE --}}
            <div>
                <select name="geostate_id" required>
                    @foreach($geostates AS $state)
                        <option value="{{ $state->id }}"
                            @if($school->geostate_id == $state->id) selected @endif
                        >
                            {{ $state->abbr }}

                        </option>
                    @endforeach
                </select>
                @error('geostate_id')
                    <x-messages.error message="{{ $message }}" />
                @enderror
            </div>

            {{-- POSTAL CODE --}}
            <div>
                <input
                    class=" @error('postal_code') bg-red-50 @enderror short-text mb-1"
                    type="text"
                    name="postal_code"
                    value="{{ $school->postal_code }}"
                    required
                />
                @error('postal_code')
                    <x-messages.error message="{{ $message }}" />
                @enderror
            </div>
        </div>
    </div>

    <div class="input-group">
        <label for="colors[0]">School Colors</label>
        <div class="col2row">
            <div class="flex flex-col">
                <div>
                    <input type="text" name="colors[0]"
                           class="short-text @error('colors.0') bg-red-50 @enderror short-text mb-1"
                           value="{{ array_key_exists(0, $colors) ? $colors[0] : '' }}"
                           placeholder="Color 1" />
                    <input type="text" name="colors[1]"
                           class="short-text @error('colors.1') bg-red-50 @enderror short-text mb-1"
                           value="{{ array_key_exists(1, $colors) ? $colors[1] : '' }}" placeholder="Color 2"/>
                    <input type="text" name="colors[2]"
                           class="short-text @error('colors.2') bg-red-50 @enderror short-text mb-1"
                           value="{{ array_key_exists(2, $colors) ? $colors[2] : '' }}" placeholder="Color 3"/>
                </div>
                <div>
                    @error('colors.0')
                    <div class="error-mssg">
                        <x-messages.error message="{{ $message }}"/>
                    </div>
                    @enderror
                    @error('colors.*')
                    <div class="error-mssg">
                        <x-messages.error message="{{ $message }}"/>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="input-group">
        <label for="student_body">Student Population</label>
        <input type="number" name="student_body" class="short-text @error('student_body') bg-red-50 @enderror short-text mb-1" value="{{ $school->student_body }}" placeholder="###" required />
        @error('student_body')
        <div class="error-mssg">
            <x-messages.error message="{{ $message }}" />
        </div>
        @enderror
    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
