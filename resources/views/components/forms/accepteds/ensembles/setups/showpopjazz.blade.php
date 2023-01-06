@props([
    'ensemble',
    'setup',
])
<x-forms.stylesheet />
<style>
    label{font-size: smaller;}
</style>
<form method="post" action="{{ route('users.setup.update', ['setup' => $setup]) }}" >

    @csrf

    <input type="hidden" name="ensemble_id" value="{{ $ensemble->id }}" />

    {{-- PIANO --}}
    <div class="input-group">

        <h4 for="piano">Using Grand Piano?</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="piano"
                    value="1"
                    @if($setup->piano) checked @endif
                />
                <label for="piano">Yes</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="piano"
                    value="0"
                    @if(! $setup->piano) checked @endif
                />
                <label for="piano">No</label>
            </div>
        </div>
    </div>

    {{-- ACCOMPANIMENT --}}
    <div class="input-group">

        <h4 for="accompaniment">Accompaniment</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="accompaniment"
                    value="none"
                    @if($setup->accompaniment === 'none') checked @endif
                />
                <label for="accompaniment">No Accompaniment</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="accompaniment"
                    value="cd"
                    @if( $setup->accompaniment === 'cd') checked @endif
                />
                <label for="accompaniment">CD</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="accompaniment"
                    value="band"
                    @if( $setup->accompaniment === 'band') checked @endif
                />
                <label for="accompaniment">Band</label>
            </div>
        </div>

    </div>

    {{-- BAND AWARD --}}
    <div class="input-group">

        <h4 for="band_award">Band Award</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="band_award"
                    value="none"
                    @if($setup->band_award === 'none') checked @endif
                />
                <label for="band_award">No Bamd</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="band_award"
                    value="students"
                    @if( $setup->band_award === 'students') checked @endif
                />
                <label for="band_award">All High School students with only one adult at keyboard (eligible)</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="band_award"
                    value="adults"
                    @if( $setup->band_award === 'adults') checked @endif
                />
                <label for="band_award">Many adult teachers in band (ineligible)</label>
            </div>
        </div>

    </div>

    {{-- PLATFORM --}}
    <div class="input-group">

        <h4 for="platform">Platform</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="platform"
                    value="none"
                    @if($setup->platform === 'none') checked @endif
                />
                <label for="platform">No platform</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="platform"
                    value="platforms"
                    @if( $setup->platform === 'platforms') checked @endif
                />
                <label for="platform">Platform risers: 12 are available: 4 @ 8', 4 @ 16', 4 @ 24'</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="platform"
                    value="steps"
                    @if( $setup->platform === 'steps') checked @endif
                />
                <label for="platform">4-step risers: 5 are available</label>
            </div>
        </div>

    </div>

    {{-- MICROPHONES --}}
    <div class="input-group">

        <h4 for="microphone">Microphones</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="microphone"
                    value="none"
                    @if($setup->microphone === 'none') checked @endif
                />
                <label for="platform">No microphone</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="microphone"
                    value="area"
                    @if( $setup->microphone === 'area') checked @endif
                />
                <label for="microphone">3 area-microphones plus solo microphones</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="microphone"
                    value="hand"
                    @if( $setup->microphone === 'hand') checked @endif
                />
                <label for="microphone">16 hand-held corded microphones</label>
            </div>
        </div>

    </div>

    {{-- AMP --}}
    <div class="input-group">

        <h4 for="amp">Using Roxbury Bass Amp?</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="amp"
                    value="1"
                    @if($setup->amp) checked @endif
                />
                <label for="amp">Yes</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="amp"
                    value="0"
                    @if(! $setup->amp) checked @endif
                />
                <label for="amp">No</label>
            </div>
        </div>
    </div>

    {{-- DRUM SET --}}
    <div class="input-group">

        <h4 for="drumset">Using Roxbury Drum Set?</h4>

        <div class="flex flex-col ml-4">
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="drumset"
                    value="1"
                    @if($setup->drumset) checked @endif
                />
                <label for="drumset">Yes</label>
            </div>
            <div class="flex flex-row space-x-2">
                <input
                    class="mt-1"
                    type="radio"
                    name="drumset"
                    value="0"
                    @if(! $setup->drumset) checked @endif
                />
                <label for="drumset">No</label>
            </div>
        </div>
    </div>

    {{-- INSTRUMENTATION --}}
    <div class="input-group">

        <h4 for="instrumentation">Instrumentation</h4>

        <textarea class="long-text ml-4" name="instrumentation" cols="20" rows="5">{{ $setup->instrumentation }}</textarea>

    </div>

    {{-- PROPS --}}
    <div class="input-group">

        <h4 for="props">Props</h4>

        <textarea class="long-text ml-4" name="props" cols="20" rows="5">{{ $setup->props }}</textarea>

    </div>

    {{-- INSTRUCTIONS --}}
    <div class="input-group">

        <h4 for="instructions">Special Instructions</h4>

        <textarea class="long-text ml-4" name="instructions" cols="20" rows="5">{{ $setup->instructions }}</textarea>

    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
