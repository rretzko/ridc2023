<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Main Menu') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <x-headers.event_logistics/>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- ADMIN MENU --}}
                    <x-navs.admin_menu :admin_active="$admin_active"/>

                </div>

                <form method="post" action="{{ route('admin.uploads.store') }}"
                      class="border border-gray-600 rounded mx-auto p-2 w-10/12 mb-4" enctype="multipart/form-data">

                    @csrf

                    <style>
                        label {
                            font-size: 1rem;
                            font-weight: bold;
                        }

                        select {
                            width: 20rem;
                        }
                    </style>

                    <h2 class="font-bold">Upload an mp3</h2>

                    @if($errors->any())
                        <div class="bg-red-100 text-red-800">
                            {{ implode('',$errors->all(':message')) }}
                        </div>
                    @endif

                    <div class="input-group flex flex-col">

                        <label for="venue_id">Daytime?</label>
                        <div class="flex flex-row space-x-4">
                            <div>
                                <input type="radio" name="daytime" value="1" @checked($daytime) >
                                <label>Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="daytime" value="0" @checked(! $daytime) >
                                <label>No</label>
                            </div>
                        </div>

                    </div>

                    <div class="input-group flex flex-col">

                        <label for="event_id">Event ({{ $events->count() }})</label>
                        <select name="event_id">
                            @foreach($events AS $event)
                                <option value="{{ $event->id }}">{{ $event->subtitle }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="input-group flex flex-col">

                        <label for="school_id">School ({{ $schools->count() }})</label>
                        <select name="school_id">
                            @foreach($schools AS $school)
                                <option value="{{ $school->id }}">{{ $school->shortName }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="input-group flex flex-col">

                        <label for="ensemble_id">Ensemble ({{ $ensembles->count() }})</label>
                        <select name="ensemble_id">
                            @foreach($ensembles AS $ensemble)

                                <option value="{{ $ensemble->id }}">{{ $ensemble->ensemble_name }}
                                    ({{ $ensemble->schoolName }})
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="input-group flex flex-col">

                        <label for="adjudicator_id">Adjudicator ({{ $adjudicators->count() }})</label>
                        <select name="adjudicator_id">
                            @foreach($adjudicators AS $adjudicator)
                                <option value="{{ $adjudicator->adjudicator_id }}">{{ $adjudicator->full_name }} ({{ $adjudicator->concert ? 'Concert' : 'Jazz/Pop/Show' }})</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="input-group flex flex-col">

                        <label for="partial">Partial Recording</label>
                        <select name="partial">
                            @for($i=1; $i<5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                    </div>

                    <div class="input-group flex flex-col mb-4">

                        <label for="recording">mp3 Recording</label>
                        <input name="recording" type="file" accept="audio/mp3,audio/*"/>
                        <span>Max File Size: </span>

                    </div>

                    <div class="input-group flex flex-col">

                        <label for="recording"></label>
                        <input type="submit" value="Submit"
                               class="bg-gray-100 border border-black w-1/12 cursor-pointer">

                    </div>

                    <div>
                        <a href="{{ route('admin.uploads.seed') }}" class="text-sm text-red-600">
                            One-time Mass Upload
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
