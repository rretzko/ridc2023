@props([
    'soloists',
    'students',
])
<x-forms.stylesheet />

<form method="post" action="{{ route('users.accepteds.soloists.update') }}" >

    @csrf

    {{-- CONCERT SOLOISTS --}}
    <div class="flex flex-col space-y-2 mb-4">
        <h3>Concert Soloists</h3>

        {{-- First Concert Soloist --}}
        <select name="concert_1" class="w-1/3">
            <option value="0">Select from Student roster</option>
            @foreach($students AS $student)
                <option value="{{ $student->id }}"
                @if($soloists[0]->concert && ($soloists[0]->student_id == $student->id)) selected @endif
                >
                    {{ $student->fullNameAlpha }}
                </option>
            @endforeach
        </select>

        {{-- Second Concert Soloist --}}
        <select name="concert_2" class="w-1/3">
            <option value="0">Select from Student roster</option>
            @foreach($students AS $student)
                <option value="{{ $student->id }}"
                        @if($soloists[1]->concert && ($soloists[1]->student_id == $student->id)) selected @endif
                >
                    {{ $student->fullNameAlpha }}
                </option>
            @endforeach
        </select>

    </div>

    {{-- JAZZ/POP/SHOW SOLOISTS --}}
    <div class="flex flex-col space-y-2 mb-4">
        <h3>Jazz/Pop/Show Soloists</h3>

        {{-- First Jazz/Pop/Show Soloist --}}
        <select name="jazzpopshow_1" class="w-1/3">
            <option value="0">Select from Student roster</option>
            @foreach($students AS $student)
                <option value="{{ $student->id }}"
                @if((! $soloists[2]->concert) && ($soloists[2]->student_id == $student->id)) selected @endif
                >
                    {{ $student->fullNameAlpha }}
                </option>
            @endforeach
        </select>

        {{-- Second Jazz/Pop/Show Soloist --}}
        <select name="jazzpopshow_2" class="w-1/3">
            <option value="0">Select from Student roster</option>
            @foreach($students AS $student)
                <option value="{{ $student->id }}"
                @if((! $soloists[3]->concert) && ($soloists[3]->student_id == $student->id)) selected @endif
                >
                    {{ $student->fullNameAlpha }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
