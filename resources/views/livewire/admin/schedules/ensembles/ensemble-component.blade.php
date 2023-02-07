<div class="mt-2">
    {{-- FORM --}}
    <div class=" ">
        <div class="flex flex-row justify-center space-x-1 border border-gray-200 ml-12 mr-12 py-2 rounded bg-gray-100">
            <div class="flex flex-col">
                <select wire:model="eventEnsembleId">
                    <option value="0">Select</option>
                    @foreach($eventEnsembles AS $eventEnsemble)
                        <option value="{{ $eventEnsemble->id }}">
                            {{ $eventEnsemble->ensemble_name.' ('.$eventEnsemble->schoolName.')' }}
                        </option>
                    @endforeach
                </select>
                @error('eventEnsembleId') <div class="error text-red-700 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex flex-col">
                <select wire:model="timeValue">
                    <option value="0">Select</option>

                    @foreach($times AS $key => $time)
                        <option value="{{ $key }}">
                            {{ $time['time'] }}
                        </option>
                    @endforeach

                </select>
                @error('timeValue') <div class="error text-red-700 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <button wire:click="store" class="bg-green-100 border border-green-700 ml-4 mt-1 px-2 rounded-full">
                    Update
                </button>
            </div>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if($flashMessage)
        <div class="mt-2 ml-12">
            <x-messages.success :message="$flashMessage"/>
        </div>
    @endif
    {{-- TABLE --}}
    <div class="">
        {!! $table !!}
    </div>
</div>
