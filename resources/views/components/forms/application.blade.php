@props(
[
    'application' => $application,
    'event' => '',
]
)
<x-forms.forms-style />
<x-tables.tables-style />
<div >
    <form method="post" action="{{ route('user.application.update') }}"  >

        @csrf

        @if($errors->any())
            <div class="verror bg-white" >
                <div class="bg-red-50 px-2 py-2 font-bold text-red-800">
                    Your application was NOT submitted. Please see the error message(s) below...
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif


        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $application->userName }}" class="@error('name') bg-red-100 @enderror" />
        </div>
        @error('name')
            <div class="verror">{{ $message }}</div>
        @enderror

        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $application->email }}" class="@error('email') bg-red-100 @enderror" />
        </div>
        @error('email')
        <div class="verror">{{ $message }}</div>
        @enderror

        <div class="input-group">
            <label for="email">Phones</label>
            <div class="flex flex-row mb-2">
                <input type="text" name="phone_mobile" value="{{ $application->phoneMobile }}" class="@error('phone_mobile') bg-red-100 @enderror" />
                <span class="hint">(Cell)</span>
            </div>
            @error('phone_mobile')
            <div class="verror">{{ $message }}</div>
            @enderror
            <div class="flex flex-row">
                <input type="text" name="phone_work" value="{{ $application->phoneWork ?? '' }}" class="@error('phone_work') bg-red-100 @enderror" />
                <span class="hint">(Work)</span>
            </div>
            @error('phone_work')
            <div class="verror">{{ $message }}</div>
            @enderror
        </div>

        <hr />

        {{-- SCHOOL --}}
        <div class="input-group">
            <label for="" title="Sys.Id: {{ $application->schoolId }}">School</label>
            <div class="flex flex-col space-y-1 " style="font-size: smaller;" >
                <div class="flex flex-col md:flex-row">
                    <label for="school_name" style="width: 6rem;">Name</label>
                    <input type="hidden" name="school_id" value="{{ $application->schoolId }}" />
                    <input style="font-size: smaller;" type="text" name="school_name" value="{{ $application->schoolName }}" class="@error('school_name') bg-red-100 @enderror" />
                </div>
                @error('school_name')
                <div class="verror">{{ $message }}</div>
                @enderror
                <div class="flex flex-col md:flex-row">
                    <label style="width:6rem;" for="address_1">Address</label>
                    <div class="flex flex-col">
                        <input style="font-size: 1rem;" type="text" name="address_1" value="{{ $application->address1 }}" class="mb-1 @error('address_1') bg-red-100 @enderror" />
                        @error('address_1')
                        <div class="verror">{{ $message }}</div>
                        @enderror
                        <input style="font-size: 1rem;" type="text" name="address_2" value="{{ $application->address2 }}" placeholder="Address 2" class="@error('address_2') bg-red-100 @enderror" />
                        @error('address_2')
                        <div class="verror">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col md:flex-row ">
                    <label style="width:6rem;" for="city">City,ST,Zip</label>
                    <div class="flex flex-row flex-wrap space-x-1" >
                        <input style="font-size: 1rem;" type="text" name="city"  class="@error('city') bg-red-100 @enderror" value="{{ $application->city }}" />
                        @error('city')
                        <div class="verror">{{ $message }}</div>
                        @enderror
                        <select name="geostate_id" class="@error('geostate_id') bg-red-100 @enderror" >
                            @foreach(\App\Models\Geostate::orderBy('descr')->get() AS $geostate)
                                <option value="{{ $geostate->id }}"
                                    @if($application->geostateId == $geostate->id) selected @endif
                                >
                                    {{ $geostate->descr }}
                                </option>
                            @endforeach
                        </select>
                        @error('geostate_id')
                        <div class="verror">{{ $message }}</div>
                        @enderror
                        <input style="font-size: 1rem; width: 6rem;" type="text" name="postal_code" value="{{ $application->postalCode }}"  class="@error('postal_code') bg-red-100 @enderror" />
                        @error('postal_code')
                        <div class="verror">{{ $message }}</div>
                        @enderror
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
                <x-tables.ensembles-table :application=$application />
                <div class="flex flex-row flex-wrap space-x-1 m-auto mt-1 mb-1">
                    <input type="text" style="width: 18rem;" name="newensemblename" placeholder="Add a new ensemble name and type" value="" class="@error('newensemblename') bg-red-100 @enderror" >
                    @error('newensemblename')
                    <div class="verror">{{ $message }}</div>
                    @enderror
                    <select name="newensemblecategoryid"  class="@error('newensemblecategoryid') bg-red-100 @enderror" >
                        @foreach(\App\Models\Category::all() AS $category)
                            <option value="{{ $category->id }}">{{ $category->descr }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="hint text-center">
                    NOTE: New ensembles are automatically assigned as the <b>Primary</b> ensemble.
                </div>
                @error('newensemblecategoryid')
                <div class="verror">{{ $message }}</div>
                @enderror

                <div>
                    @error('hasprimary')
                    <div class="verror">{{ $message }}</div>
                    @enderror
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
                    <input style="font-size: smaller;" type="number" name="attending_students" value="{{ old('attending_students') ?: $application->attending_students }}" class="@error('attending_students') bg-red-100 @enderror" />
                </div>
                @error('attending_students')
                <div class="verror">{{ $message }}</div>
                @enderror
                <div class="flex flex-row">
                    <label for="attending_adults" style="width: 6rem;">Adults</label>
                    <input style="font-size: smaller;" type="number" name="attending_adults" value="{{ old('attending_adults') ?: $application->attending_adults }}" class="@error('attending_adults') bg-red-100 @enderror" />
                </div>
                @error('attending_adults')
                <div class="verror">{{ $message }}</div>
                @enderror
            </div>
        </div><!-- end of counts -->

        <hr />

        {{-- MAILING INSTRUCTIONS --}}
        <div id="mailing_instructions">
            <div class="instructions text-center">
                Return form with payment by Friday, November 10, 2023 to:<br />
                <div class="font-bold flex flex-col text-center">
                    <div>Your check should be made out to: <b>RHS CHOIR</b> and sent to:</div>
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
                    @php($acceptApplications = false)
                    @if($acceptApplications)
                        <input style="background-color: black; color: white; max-width: 10rem;"  class="rounded-full px-2 m-auto" type="submit" name="submit" value="Submit">
                    @else
                        <div>
                            Applications will be accepted after January 1, 2026.
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white border border-black p-2 mt-2" style="width: 50%; text-align: center;">
                <div class="flex flex-row justify-center space-x-1">
                    <h2>Invoice</h2>
                    <a href="{{ route('user.application.pdf') }}" class="text-xs mt-2 text-blue-600">
                        (pdf download)
                    </a>
                </div>
                Payment for {{ $application->ensemble_count }} ensembles @
                ${{ number_format($application->ensemble_fee,2) }}/ensemble:
                ${{ number_format($application->paymentDue, 2) }}
            </div>
        </div>

    </form>
</div>
