<div>
    {{-- SUCCESS MESSAGE --}}
    @if(session()->has('success'))
        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;font-size: 0.8rem; margin: auto; margin-top: 1rem; padding: 0 0.5rem; ">
            {{ session()->get('success') }}
        </div>
    @endif

    {{-- DOWNLOAD APPLICATIONS --}}
    <div class="flex flex-row justify-end mr-2 my-2">
        <a href="{{ route('admin.rosters.applicants.download') }}">
            <button class="bg-green-200 text-green-800 border border-green-800 px-2 rounded-full text-sm">
                Download
            </button>
        </a>
    </div>

    {{-- APPLICATION CARDS --}}
    <div id="applications-table">
        @forelse($users AS $user)
            <div id="applicant card" class="mb-2 border border-gray-600 p-2 flex flex-row mx-2">

                {{-- BIO --}}
                <div id="bio" class="w-1/3 border border-white border-r-gray-200 mr-4">
                    <div class="flex flex-col">
                        <div class="font-bold text-2xl">
                            {{ $user->nameAlpha }}
                        </div>
                        <div class="">
                            {{ $user->email }}
                        </div>
                        <div class="">
                            <div class="flex flex-row">
                                <div class="w-16">Cell:</div>
                                <div>{{ $user->phoneMobile }}</div>
                            </div>
                            <div class="flex flex-row">
                                <div class="w-16">Work:</div>
                                <div>{{ $user->phoneWork }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SCHOOL --}}
                <div id="school" class="w-1/3 border border-white border-r-gray-200 mr-4">
                    <div class="flex flex-col">
                        <div class="font-bold text-2xl">

                            {{ $user->person->school->shortName }}
                        </div>
                        <div class="">
                            {{ $user->person->school->city.', '.$user->person->school->geostateAbbr }}
                        </div>
                        <div class="">
                            <div class="">
                                <div class="font-bold">{{ $user->person->school->eventEnsemblesPrimary()->ensemble_name }} ({{ $user->person->school->eventEnsemblesPrimary()->category->descr }})</div>
                            </div>

                            <div class="text-sm">
                                @forelse($user->person->school->eventEnsemblesSecondary() AS $eventensemble)
                                    <div>{{ $eventensemble->ensemble_name }} ({{$eventensemble->category->descr}})</div>
                                @empty
                                    <div>No secondary ensembles</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div id="counts" class="w-1/3">
                    <div class="flex flex-col">
                        <div class="font-bold text-2xl">
                            Counts
                        </div>
                        <div class="">

                            Students: {{ $user->person->school->eventAttendingStudents }}
                        </div>
                        <div class="">
                            Adults: {{ $user->person->school->eventAttendingAdults }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div>No Applicants Found</div>
        @endforelse
    </div>
</div>

