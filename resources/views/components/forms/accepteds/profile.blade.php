@props([
'honorifics',
'user',
])

<x-forms.stylesheet />

<form method="post" action="{{ route('users.accepteds.profiles.update') }}">

    @csrf

    <div class="input-group">
        <label for="first">Name</label>
        <div class="col2row ">

            {{-- HONORIFIC --}}
            <select name="honorific_id" class="col2row" style="width: 8rem;">
                @foreach($honorifics AS $honorific)
                    <option value="{{ $honorific->id }}"
                        @if($user->honorific_id == $honorific->id) SELECTED @endif
                    >
                        {{ $honorific->descr }}
                    </option>
                @endforeach
            </select>
            @error('honorific_id')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror

            {{-- FIRST NAME --}}
            <input
                class="col2row @error('first') bg-red-50 @enderror"
                type="text"
                name="first"
                value="{{ $user->first }}"
                placeholder="First name"
                required
            />

            {{-- ERRORS: First, Middle, and Last Names --}}
            @error('first')
                <div class="error-mssg">
                    {{ $message }}
                </div>
            @enderror
            @error('middle')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror
            @error('last')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror

            {{-- MIDDLE NAME --}}
            <input
                class="col2row @error('middle') bg-red-50 @enderror"
                type="text"
                name="middle"
                value="{{ $user->middle }}"
                placeholder="Middle name"/>

            {{-- LAST NAME --}}
            <input
                class="col2row @error('last') bg-red-50 @enderror"
                type="text"
                name="last"
                value="{{ $user->last }}"
                placeholder="Last name" required />

            {{-- SUFFIX --}}
            <input
                class="col2row  @error('suffix') bg-red-50 @enderror"
                style="width: 8rem; max-width: 8rem; min-width: 8rem;"
                type="text"
                name="suffix"
                value="{{ $user->suffix }}" placeholder="Suffix ex: Jr, III, etc." />
        </div>
    </div>

    {{-- EMAIL --}}
    <div class="input-group">
        <label for="email">Email</label>
        <input
            class=" @error('email') bg-red-50 @enderror"
            type="email"
            name="email"
            value="{{ $user->email }}"
            required />
        @error('email')
        <div class="error-mssg">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- PHONES --}}
    <div class="input-group">
        <label for="phone_mobile">Phones</label>
        <div class="col2row ">
            <div style="display: flex; flex-direction: row;">

                {{-- MOBILE PHONE --}}
                <input
                    class="col2row @error('phone_mobile') bg-red-50 @enderror"
                    type="text"
                    name="phone_mobile"
                    value="{{ $user->phone_mobile }}"
                      placeholder="Cell phone"
                    required/>
                <span class="hint">(Cell)</span>
            </div>

            {{-- ERRORS: Mobile and Work Phones --}}
            @error('phone_mobile')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror
            @error('phone_work')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror

            {{-- WORK PHONE --}}
            <div style="display: flex; flex-direction: row;">
                <input
                    class="col2row @error('phone_work') bg-red-50 @enderror"
                    type="text"
                    name="phone_work"
                    value="{{ $user->phone_work }}"
                    placeholder="Work phone"
                />
                <span class="hint">(Work)</span></div>
        </div>
    </div>

    {{-- JOB TITLE --}}
    <div class="input-group">
        <label for="job_title">Job Title</label>
        <input
            class="@error('job_title') bg-red-50 @enderror"
            type="text"
            name="job_title"
            value="{{ $user->person->job_title }}"
            placeholder="Choral Director"
            required
        />
    </div>
    @error('job_title')
    <div class="error-mssg">
        {{ $message }}
    </div>
    @enderror

    <div class="input-group">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
