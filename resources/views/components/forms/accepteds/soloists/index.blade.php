@props([
    'countSoloistsConcert' => 0,
    'countSoloistsJPS' => 0,
    'students',
])
<x-forms.stylesheet />

<div>

    {{-- CONCERT SOLOISTS --}}
    <div class="flex flex-col space-y-2 mb-4">
        <style>
            .labelDiv{width: 8rem;}
        </style>

        {{-- Blank Soloist Form --}}
        <form style=" border: 1px solid darkgray; padding: 0.5rem;"
              method="post"
              action="{{ route('users.accepteds.soloists.store') }}"
        >
            @csrf

            <div style="margin-bottom: 0.25rem">
                <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.25rem;">New Soloist</h3>

                {{-- SOLOIST TYPE RADIO BUTTONS --}}
                <label for="studentId" style="display: flex; flex-direction: row; margin-bottom: 0.25rem;">
                    <span class="labelDiv">Soloist Type</span>
                    <div style="display: flex; flex-direction: column;">
                        @if($countSoloistsConcert < 2)
                            <div>
                                <input type="radio" id="soloistType" name="soloistType" value="1" checked>
                                <label for="soloistType">Concert</label>
                            </div>
                        @endif
                        @if($countSoloistsJPS < 2)
                            <div>
                                <input type="radio" id="soloistType" name="soloistType" value="0"
                                       @if($countSoloistsConcert > 1) checked @endif
                                >
                                <label for="soloistType">Jazz, Pop, or Show</label>
                            </div>
                        @endif


                    </div>
                </label>

                <label for="studentId" style="display: flex; flex-direction: row;">
                    <span class="labelDiv">Student</span>
                    <select id="studentId" name="studentId" class="w-1/3" autofocus>
                        <option value="0">Select from Student roster</option>
                        @foreach($students AS $student)
                            <option value="{{ $student->id }}" >
                                {{ $student->fullNameAlpha }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <div style="margin-bottom: 0.25rem;">
                    <label for="" style="display: flex; flex-direction: row;">
                        <span class="labelDiv"></span>
                        <span class="text-red-800 text-sm italic">
                            @error('studentId') {{ $message }} @enderror
                        </span>
                    </label>
                </div>
            </div>

            <div style="margin-bottom: 0.25rem;">
                <label for="title" style="display: flex; flex-direction: row;">
                    <span class="labelDiv">Song Title</span>
                    <input
                        style="box-sizing: content-box;"
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') ?: '' }}"
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
                        value="{{ old('composer') ?: '' }}"
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

        {{-- SOLOIST TABLE --}}
    </div>

    <script>
        function echoValue($from, $to)
        {
            document.getElementById($to).innerText = document.getElementById($from).value;
        }
    </script>

</div>
