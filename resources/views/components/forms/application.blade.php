<x-forms.forms-style />
<x-tables.tables-style />
<div >
    <form method="post" action=""  >

        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" value="{{ auth()->user()->name }}" />
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" value="{{ auth()->user()->email }}" />
        </div>

        <div class="input-group">
            <label for="email">Phones</label>
            <div class="flex flex-row mb-2">
                <input type="text" value="{{ auth()->user()['person']->phone_mobile ?? '' }}"/>
                <span class="hint">(Cell)</span>
            </div>
            <div class="flex flex-row">
                <input type="text" value="{{ auth()->user()['person']->phone_work ?? '' }}" />
                <span class="hint">(Work)</span>
            </div>
        </div>

        <hr />

        {{-- SCHOOL --}}
        <div class="input-group">
            <label for="">School</label>
            <div class="flex flex-col space-y-1 " style="font-size: smaller;" >
                <div class="flex flex-col md:flex-row">
                    <label for="school_name" style="width: 6rem;">Name</label>
                    <input style="font-size: smaller;" type="text" name="school_name" value="{{ auth()->user()['person']['school']->school_name }}"/>
                </div>
                <div class="flex flex-col md:flex-row">
                    <label style="width:6rem;" for="address_1">Address</label>
                    <div class="flex flex-col">
                        <input style="font-size: 1rem;" type="text" name="address_1" value="{{ auth()->user()['person']['school']->address_1 }}" class="mb-1"/>
                        <input style="font-size: 1rem;" type="text" name="address_2" value="{{ auth()->user()['person']['school']->address_2 }}" placeholder="Address 2"/>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row ">
                    <label style="width:6rem;" for="city">City,ST,Zip</label>
                    <div class="flex flex-row flex-wrap space-x-1">
                        <input style="font-size: 1rem;" type="text" name="city" value="{{ auth()->user()['person']['school']->city }}" />
                        <select name="geostate_id">
                            @foreach(\App\Models\Geostate::orderBy('descr')->get() AS $geostate)
                                <option value="{{ $geostate->id }}"
                                    @if(auth()->user()['person']['school']->geostate_id == $geostate->id) selected @endif
                                >
                                    {{ $geostate->descr }}
                                </option>
                            @endforeach
                        </select>
                        <input style="font-size: 1rem; width: 6rem;" type="text" name="postal_code" value="{{ auth()->user()['person']['school']->postal_code }}" />
                    </div>
                </div>

            </div>
        </div><!-- end of School -->

        <hr />

        {{-- ENSEMBLES --}}
        <div class="input-group">
            <label for="">Ensembles ({{ auth()->user()['person']['school']['ensembles']->count() }})</label>

            <div class="instructions">
                <p>
                    Please select one <b>Primary</b> ensemble for your application.
                </p>
                <p>
                    If you wish to bring <u>more than</u> one ensemble, mark these as <b>Secondary</b> choices. We will
                    get back to you as quickly as possible regarding the additional ensembles.
                </p>
            </div>

            <div class="flex flex-col">
                <x-tables.ensembles-table />
                <div class="flex flex-row flex-wrap space-x-1 m-auto mt-1">
                    <input type="text" style="width: 18rem;" placeholder="Add a new ensemble name and type" value="">
                    <select>
                        @foreach(\App\Models\Category::all() AS $category)
                            <option value="{{ $category->id }}">{{ $category->descr }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div><!-- end of ensembles -->

        <hr />

        {{-- COUNTS --}}
        <div class="input-group">
            <label for="">Attending Counts </label>
            <div class="flex flex-col space-y-1 " style="font-size: smaller;" >
                <div class="flex flex-row">
                    <label for="attending_students" style="width: 6rem;">Students</label>
                    <input style="font-size: smaller;" type="number" name="attending_students" value="{{ old('attending_students') ?: 1 }}"/>
                </div>
                <div class="flex flex-row">
                    <label for="attending_adults" style="width: 6rem;">Adults</label>
                    <input style="font-size: smaller;" type="number" name="attending_adults" value="{{ old('attending_adults') ?: 1 }}"/>
                </div>
            </div>
        </div><!-- end of counts -->

        <hr />

        {{-- MAILING INSTRUCTIONS --}}
        <div id="mailing_instructions">
            <div class="instructions text-center">
                Return form with payment by November 11, 2022 to:<br />
                <div class="font-bold flex flex-col text-center">
                    <div>Patrick Hachey</div>
                    <div>1 Bryant Drive</div>
                    <div>Succasunna, NJ 07876</div>
                    <div>Phone: (973) 584-1200 x12500</div>
                    <div>Fax: (973) 598-8268</div>
                </div>
            </div>
        </div>

        <hr />

        {{-- SUBMIT & INVOICE --}}
        <div class="flex flex-row flex-wrap">
            <div style="width: 50%; text-align: center;">
                <div class="instructions">
                    Please click the button to submit the form and recalculate your invoice.
                </div>
                <div>
                    <input style="background-color: black; color: white; max-width: 10rem;"  class="rounded-full px-2 m-auto" type="submit" name="submit" value="Submit">
                </div>
            </div>

            <div class="bg-white border border-black p-2 mt-2" style="width: 50%; text-align: center;">
                <div class="flex flex-row justify-center space-x-1">
                    <h2>Invoice</h2>
                    <a href="" class="text-xs mt-2 text-blue-600">
                        (pdf download)
                    </a>
                </div>
                Payment for x ensembles: $###.##
            </div>
        </div>

    </form>
</div>
