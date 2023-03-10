@props([
    'ensemble',
    'setup',
])
<x-forms.stylesheet />

<form method="post" action="{{ route('users.setup.update', ['setup' => $setup]) }}" >

    @csrf

    <input type="hidden" name="ensemble_id" value="{{ $ensemble->id }}" />

    {{-- TITLE --}}
    <div class="input-group">

        <label for="piano">Using Grand Piano?</label>

        <div class="flex flex-col">
            <div class="flex flex-row space-x-2">
                <input
                    class=""
                    type="radio"
                    name="piano"
                    value="1"
                    @if($setup->piano) checked @endif
                />
                <label for="piano">Yes</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class=""
                    type="radio"
                    name="piano"
                    value="0"
                    @if(! $setup->piano) checked @endif
                />
                <label for="piano">No</label>
            </div>
        </div>

    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
