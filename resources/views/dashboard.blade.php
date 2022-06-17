<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ \App\Models\CurrentEvent::currentEvent()->eventDateDMdY }}</div>
    </div>
<!--
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- STATUS BADGES --}}
                    <div id="status_badges" class="flex flex-col">
                        <style>
                            .badge{
                                background-color: lightgrey;
                                border: 1px solid darkgrey;
                                border-radius: .5rem;
                                color: darkgrey;
                                margin-left: 0.5rem;
                                padding:0 0.25rem;
                                text-align: center;
                            }
                            .active_badge{
                                background-color: rgba(0,255,0,0.1);
                                border: 1px solid darkgreen;
                                color: darkgreen;
                            }
                        </style>
                        <div id="col1" class="flex flex-row">
                            <span>You are:</span>
                            <div class="ml-4 badge active_badge">Guest</div>
                            <div class="ml-4 badge ">Invited</div>
                            <div class="ml-4 badge">Fee</div>
                            <div class="ml-4 badge">Accepted</div>
                        </div>
                        <div class="flex flex-row justify-between mt-1 px-6">
                            <div class="badge">Students</div>
                            <div class="badge">Repertoire</div>
                            <div class="badge">Ensembles</div>
                            <div class="badge">Soloists</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    --}} -->
</x-app-layout>
