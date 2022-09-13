<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ \App\Models\CurrentEvent::currentEvent()->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.application />

        <div id="main" >

            <style>
                form{font-size: 1.3rem;}
                .input-group{display: flex; flex-direction: column; font-size: 1rem; margin-bottom: 0.25rem;}
                .input-group label{font-size: 1rem; min-width: 8rem;}
                .input-group input,select{border: 1px solid black; font-size: 1rem;}
                .input-group input{padding: 0.25rem;}
                .input-group select{font-size: 0.8rem;}

                @media only screen and (min-width:800px){
                    .input-group{display: flex; flex-direction: row; font-size: 1rem; margin-bottom: 0.25rem;}
                }
            </style>

            {{-- CONTACT FORM  --}}
            <div class="justify-center p-6 border" style="border: 1px solid black; border-radius: 1rem; width: 90%; margin: auto;">
                <h3 style="padding: 0; margin: 0; margin-bottom: 1rem;font-size: 1.25rem;">Contact Form</h3>

                {{-- SUCCESS MESSAGE --}}
                @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div style="padding: 0.25rem; border: 1px solid darkgreen; background-color: rgba(0,255,0,0.1); color: black; font-size: 0.8rem;">
                        {!! \Illuminate\Support\Facades\Session::get('success') !!}
                    </div>
                @endif

                <form action="{{ route('contact.update') }}" method="POST" >

                    @csrf

                    <div class="input-group">
                        <label>First name</label>
                        <div>{{ auth()->user()->first }}</div>
                        <input type="hidden" name="firstname" value="{{ auth()->user()->first }}" />
                    </div>
                    <div class="input-group">
                        <label>Last name</label>
                        <div>{{ auth()->user()->last }}</div>
                        <input type="hidden" name="lastname" value="{{ auth()->user()->last }}" />
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <div>{{ auth()->user()->email }}</div>
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
                    </div>
                    <div class="input-group">
                        <label>School name</label>
                        <div>{{ auth()->user()->person['school']->school_name }}</div>
                        <input type="hidden" name="school" value="{{ auth()->user()->person['school']->school_name }}" />
                    </div>
                    <div class="input-group">
                        <label>State</label>
                        <div>{{ auth()->user()->person['school']->geostateAbbr }}</div>
                        <input type="hidden" name="geostate_id" value="{{ auth()->user()->person['school']->geostate_id }}" />
                    </div>
                    <div class="input-group">
                        <label>Comment</label>
                        <textarea cols="40" rows="5" name="comment" style="border: 1px solid black; @error('comment') border: 1px solid darkred; background-color: rgba(255,0,0,0.1); @enderror" placeholder="Thanks for reaching out!  What questions do you have?">{{ old('comment') }}</textarea>
                        @error('comment')
                        <div style="color: red; margin-left: 0.25rem;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label></label>
                        <input type="submit" name="submit" style="border-radius: 0.5rem; margin-top: 1rem; "value="Send" />
                    </div>
                </form>
            </div>

        </div>

</x-app-layout>
