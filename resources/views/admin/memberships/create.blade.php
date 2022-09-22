<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Membership Add') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <x-headers.event_logistics />

    <div class="py-2">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- ADMIN MENU --}}
                    <x-navs.admin_menu :admin_active=$admin_active />

                    {{-- ROSTERS MENU --}}
                    <x-navs.roster_menu :roster_active=$roster_active />

                    {{-- Instructions --}}
                    <x-instructions.instructions  >
                        <x-instructions.admin.membership />
                    </x-instructions.instructions>

                    {{-- SUCCESS MESSAGE --}}
                    @if(session()->has('success'))
                        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;font-size: 0.8rem; margin: auto; margin-top: 1rem; padding: 0 0.5rem; ">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        @foreach($errors AS $err)
                            <div>{{ $err->$message }}</div>
                        @endforeach
                    @endif
                </div>

                {{-- FORM --}}
                <div style="width: 80%; margin: 1rem auto; padding: 1rem; border: 1px solid darkgrey; border-radius: 0.5rem; ">
                    <form method="post" action="{{ route('admin.rosters.membership.store') }}" class="bg-gray-100 p-4 rounded" >
                        <style>
                            label{font-size: 1rem;}
                            .input-group{display: flex; flex-direction: column; margin-bottom: 0.5rem;}

                        </style>
                        @csrf
                        <h3 class="mb-2"> Add New Member</h3>
                        {{-- NAME --}}
                        <div class="input-group">
                            <label for="first">Name</label>
                            <div class="flex flex-row space-x-1">
                                <input type="text" name="first" value="" placeholder="Mary"/>
                                <input type="text" name="middle" value="" />
                                <input type="text" name="last" value="" placeholder="Washington"/>
                            </div>
                            <div>
                                @error('first')
                                    <div class="err-mssg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="input-group">
                            <label for="email">eMail</label>
                            <div class="flex flex-row space-x-1">
                                <input type="text" name="email" value="" placeholder="name@example.com"/>
                            </div>
                        </div>

                        {{-- SCHOOL --}}
                        <div class="input-group">
                            <div>
                                <label for="school_id">Select a School </label>
                                <div class="">
                                    <select name="school_id">
                                        @foreach(\App\Models\School::orderBy('school_name')->get() AS $school)
                                            <option value="{{ $school->id }}" >
                                                {{ $school->school_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="school-add" class="flex flex-col">
                                <label for="school_name">Or: Add a NEW School</label>
                                <input type="text" name="school_name" value="" placeholder="Central High School" />
                            </div>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="input-group">
                            <label></label>
                            <div class="element">
                                <input type="submit" name="submit" value="Add" class="border border-gray-600 p-2 rounded-full shadow-lg"/>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
