@props([
    'soloist',
    'students',
])
<x-forms.stylesheet />

<div>

    {{-- CONCERT SOLOISTS --}}
    <div class="flex flex-col space-y-2 mb-4">
        <style>
            .labelDiv{width: 8rem;}
        </style>
        <h3>Edit Soloist: {{ $soloist->fullNameAlpha }}</h3>

        {{-- First Concert Soloist --}}
        <form style=" border: 1px solid darkgray; padding: 0.5rem;"
              method="post"
              action="{{ route('users.accepteds.soloists.update', ['soloist' => $soloist]) }}"
        >
            @csrf

            <div style="margin-bottom: 0.25rem; display: flex; flex-direction: row;">
                <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;">Solo Type</h3>
                <label for="soloType" style="font-weight: bold; margin-left: 1rem;">
                    <span class="labelDiv">{{ $soloist->category }}</span>
                </label>
            </div>


            <div style="margin-bottom: 0.25rem;">
                <label for="title" style="display: flex; flex-direction: row;">
                    <span class="labelDiv">Song Title</span>
                    <input
                        style="box-sizing: content-box;"
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') ?: $soloist->title }}"
                        onkeyup="echoValue('title', 'titleEcho')"
                    />
                    <span id="titleEcho" style="margin-left: 1.25rem; margin-top: 0.25rem; font-size: 0.8rem;">
                        {{-- javascript echo --}}
                    </span>
                </label>
                <div style="margin-bottom: 0.25rem;">
                    <label for="" style="display: flex; flex-direction: row;">
                        <span class="labelDiv"></span>
                        <span class="text-red-800 text-sm italic">
                            @error('title') {{ $message }} @enderror
                        </span>
                    </label>
                </div>
            </div>

            <div style="margin-bottom: 0.25rem;">
                <label for="composer_1" style="display: flex; flex-direction: row;">
                    <span class="labelDiv">Composer</span>
                    <input
                        style="box-sizing: content-box;"
                        type="text"
                        id="composer"
                        name="composer"
                        value="{{ old('composer') ?: $soloist->composer }}"
                        onkeyup="echoValue('composer', 'composerEcho')"
                    />
                    <span id="composerEcho" style="margin-left: 1.25rem; margin-top: 0.25rem; font-size: 0.8rem;">
                        {{-- javascript echo --}}
                    </span>
                </label>
                <div style="margin-bottom: 0.25rem;">
                    <label for="" style="display: flex; flex-direction: row;">
                        <span class="labelDiv"></span>
                        <span class="text-red-800 text-sm italic">
                            @error('composer') {{ $message }} @enderror
                        </span>
                    </label>
                </div>
            </div>

            <div class="input-group mt-4">
                <label></label>
                <x-buttons.submit />
            </div>

        </form>

    </div>

    <script>
        function echoValue($from, $to)
        {
            document.getElementById($to).innerText = document.getElementById($from).value;
        }
    </script>

</div>
