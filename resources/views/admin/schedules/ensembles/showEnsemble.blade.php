<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ensembles Schedule') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <x-headers.event_logistics />

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- ADMIN MENU --}}
                    <x-navs.admin_menu :admin_active="$admin_active"/>

                </div>

                {{-- ENSEMBLES TABLE BUTTONS --}}
                <div class="flex flex-row justify-end space-x-2 mr-12">
                    <div class="">
                        <a href="{{ route('admin.schedules.ensembles.edit') }}">
                            <button class="bg-indigo-200 rounded-full px-2 text-sm">
                                Update Schedule
                            </button>
                        </a>
                    </div>

                    <div class="">
                        <a href="{{ route('admin.schedules.ensembles.show') }}">
                            <button class="bg-yellow-300 rounded-full px-2 text-sm">
                                Daytime Schedule
                            </button>
                        </a>
                    </div>

                    <div class="">
                        <a href="{{ route('admin.schedules.ensembles.csv') }}">
                            <button class="bg-fuchsia-300 rounded-full px-2 text-sm">
                                Download Csv
                            </button>
                        </a>
                    </div>

                </div>

                {{-- ENSEMBLE EDIT FORM --}}
                <div class="mt-2">
                    <form method="post" action="{{ route('admin.schedules.ensembles.updateEnsemble', ['ensemble' => $ensemble]) }}">

                        @csrf

                        <div class=" space-x-1 border border-gray-200 ml-12 mr-12 px-2 py-2 rounded bg-gray-100">
                            {{-- HEADER --}}
                            <div>
                                <h3 class="text-left font-semibold">School: {{ $ensemble->school_name }}</h3>
                            </div>

                            {{-- ENSEMBLE NAME --}}
                            <div class="flex flex-row mr-8">
                                <label for="ensemble_name" class="mr-3">Name</label>
                                <input type="text" name="ensemble_name" value="{{ $ensemble->ensemble_name }}"
                            </div>

                            {{-- ENSEMBLE CATEGORY --}}
                            <div class="flex flex-row ml-8">
                                <label for="ensemble_name" class="mr-3">Category</label>
                                <select name="category_id">
                                    @foreach($categories AS $category)
                                        <option value="{{ $category->id }}"
                                            @selected($ensemble->category_id === $category->id)
                                        >
                                            {{ $category->descr }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label></label>
                                <input type="submit" class="ml-8 border border-black px-4 bg-gray-300 rounded" name="submit" value="Update" />
                            </div>

                        </div>
                    </form>
                </div>

                {{-- ENSEMBLES TABLE --}}
                <div class="">
                    {!! $table !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
