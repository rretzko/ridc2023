@props([
    'ensemble',
])
<x-forms.stylesheet />

<form method="post" action="{{ route('users.repertoire.store') }}" >

    @csrf

    {{-- ENSEMBLE ID --}}
    <input type="hidden" name="ensemble_id" value="{{ $ensemble->id }}" />

    {{-- TITLE --}}
    <div class="input-group">

        <label for="title">Title</label>

        <input
            class="long-text @error('title') bg-red-50 @enderror"
            type="text"
            name="title"
            value="{{ old('title') }}"
            placeholder=""
            required
        />

        {{-- ERRORS: Title --}}
        @error('title')
        <div class="error-mssg">
            {{ $message }}
        </div>
        @enderror

    </div>

    {{-- SUBTITLE --}}
    <div class="input-group">

        <label for="subtitle">Subtitle</label>

        <input
            class="long-text @error('subtitle') bg-red-50 @enderror"
            type="text"
            name="subtitle"
            value="{{ old('subtitle') }}"
            placeholder=""
        />

        {{-- ERRORS: Title --}}
        @error('subtitle')
            <div class="error-mssg">
                {{ $message }}
            </div>
        @enderror
    </div>

        {{-- ARTISTS --}}
        <div class="input-group">

            <label for="composer">Artists</label>

            <div class="space-y-2">

                {{-- COMPOSER --}}
                <div class="flex flex-row">
                    <input
                        class="long-text @error('composer') bg-red-50 @enderror"
                        type="text"
                        name="composer"
                        value="{{ old('composer') }}"
                        placeholder="Composer"
                    />
                    <span class="hint">(Composer)</span>
                </div>

                {{-- ERRORS: Composer --}}
                @error('composer')
                    <div class="error-mssg">
                        {{ $message }}
                    </div>
                @enderror

                {{-- ARRANGER --}}
                <div class="flex flex-row">
                    <input
                        class="long-text @error('arranger') bg-red-50 @enderror"
                        type="text"
                        name="arranger"
                        value="{{ old('arranger') }}"
                        placeholder="Arranger"
                    />
                    <span class="hint">(Arranger)</span>
                </div>

                {{-- ERRORS: Arranger --}}
                @error('arranger')
                <div class="error-mssg">
                    {{ $message }}
                </div>
                @enderror

                {{-- LYRICIST --}}
                <div class="flex flex-row">
                    <input
                        class="long-text @error('lyricist') bg-red-50 @enderror"
                        type="text"
                        name="lyricist"
                        value="{{ old('lyricist') }}"
                        placeholder="Lyricist"
                    />
                    <span class="hint">(Lyricist)</span>
                </div>

                {{-- ERRORS: Lyricist --}}
                @error('lyricist')
                <div class="error-mssg">
                    {{ $message }}
                </div>
                @enderror

                {{-- CHOREOGRAPHER --}}
                <div class="flex flex-row">
                    <input
                        class="long-text @error('choreographer') bg-red-50 @enderror"
                        type="text"
                        name="choreographer"
                        value="{{ old('choreographer') }}"
                        placeholder="Choreographer"
                    />
                    <span class="hint">(Choreographer)</span>
                </div>

                {{-- ERRORS: Choreographer --}}
                @error('choreographer')
                <div class="error-mssg">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

    </div>

    {{-- PERFORMANCE NOTES --}}
    <div class="input-group">

        <label for="notes">Performance Notes</label>

        <input
            class="long-text @error('notes') bg-red-50 @enderror"
            type="text"
            name="notes"
            value="{{ old('notes') }}"
            placeholder=""
            required
        />

        {{-- ERRORS: Notes --}}
        @error('notes')
        <div class="error-mssg">
            {{ $message }}
        </div>
        @enderror

    </div>

    {{-- PERFORMANCE TIME --}}
    <div class="input-group">

        <label for="minutes">Performance Time</label>

        <div class="flex flex-row space-x-2">

            <div class="flex flex-col">
                <div class="text-sm text-center">
                    Minutes
                </div>
                <div>
                    <select name="minutes">
                        @for($i=0; $i<60; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="flex flex-col">
                <div class="text-sm text-center">
                    Seconds
                </div>
                <div>
                    <select name="seconds">
                        @for($i=0; $i<60; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        {{-- ERRORS: Performance Time --}}
        @error('duration')
        <div class="error-mssg">
            {{ $message }}
        </div>
        @enderror

    </div>

    {{-- PERFORMANCE ORDER --}}
    <div class="input-group">

        <label for="notes">Performance Order</label>

        <select class="short-text" name="order_by">
            @for($i=1; $i<8; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        {{-- ERRORS: Order_By --}}
        @error('order_by')
        <div class="error-mssg">
            {{ $message }}
        </div>
        @enderror

    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
