@props([
'user',
])

<x-forms.stylesheet />

<form method="post" action="">

    @csrf

    <div class="input-group">
        <label for="first">Name</label>
        <div class="col2row ">
            <input class="col2row" type="text" name="honorific" value="Mr/Ms/Dr" placeholder="honorific" />
            <input class="col2row" type="text" name="first" value="{{ $user->first }}" placeholder="First name" required />
            <input class="col2row" type="text" name="middle" value="{{ $user->middle }}" placeholder="Middle name"/>
            <input class="col2row" type="text" name="last" value="{{ $user->last }}" placeholder="Last name" required />
            <input class="col2row" type="text" name="suffix" value="" placeholder="Suffix ex: Jr, III, etc." />
        </div>
    </div>

    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required />
    </div>

    <div class="input-group">
        <label for="phone_mobile">Phones</label>
        <div class="col2row ">
            <div style="display: flex; flex-direction: row;">
                <input class="col2row" type="text" name="phonem_obile" value="{{ $user->phone_mobile }}"
                      placeholder="Cell phone" required/>
                <span class="hint">(Cell)</span>
            </div>
            <div style="display: flex; flex-direction: row;">
                <input class="col2row" type="text" name="phone_work" value="{{ $user->phone_work }}"
                      placeholder="Work phone"/>
                <span class="hint">(Work)</span></div>
        </div>
    </div>

    <div class="input-group">
        <label for="job_title">Job Title</label>
        <input type="text" name="job_title" value="{{ $user->job_title }}" placeholder="Choral Director" required />
    </div>

    <div class="input-group">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
