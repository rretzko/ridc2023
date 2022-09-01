<style>
    .input-group{margin-bottom: 0.25rem; margin-left: 0.5rem;display: flex; flex-direction: column;}
    label{margin-left: 0.5rem;}
    .verror{margin-left: 0.5rem; border: 1px solid darkred; color: red; padding: 0 0.25rem; font-size: 0.8rem;}
</style>

        <form method="post" action="{{ route('admin.events.store') }}" >

            @csrf

            <h2>Add a new event</h2>

            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       style="@error('title') background-color: rgba(255,0,0,0.1) @enderror"
                       value="{{ old('title') ?: 'Roxbury Invitational' }}"
                />
            </div>
            @error('title')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" name="subtitle"
                       style="@error('title') background-color: rgba(255,0,0,0.1) @enderror"
                       value="{{ old('subtitle') ?: '##th Annual' }}"
                />
            </div>
            @error('subtitle')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="descr">Description</label>
                <textarea rows="2" name="descr" style="@error('descr') background-color: rgba(255,0,0,0.1) @enderror" >{{ old('descr') ?: 'Concert, Show, Jazz and Pop Choir Invitational' }}</textarea>
            </div>
            @error('descr')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="open_date">Open</label>
                <input style="max-width: 10rem; @error('open_date') background-color: rgba(255,0,0,0.1) @enderror "
                       type="date"
                       name="open_date"
                       value="{{ old('open_date') ?: 1 }}"

                >
            </div>
            @error('open_date')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="close_date">Close</label>
                <input style="max-width: 10rem; @error('open_date') background-color: rgba(255,0,0,0.1) @enderror "
                       type="date"
                       name="close_date"
                       value="{{ old('close_date') ?: 1 }}"

                >
            </div>
            @error('close_date')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="event_date">Event Date</label>
                <input style="max-width: 10rem; @error('event_date') background-color: rgba(255,0,0,0.1) @enderror "
                       type="date"
                       name="event_date"
                       value="{{ old('event_date') ?: 1 }}"
                >
            </div>
            @error('event_date')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="start_time">Start Time</label>
                <input style="max-width: 10rem; @error('start_time') background-color: rgba(255,0,0,0.1) @enderror "
                       type="time"
                       name="start_time"
                       value="{{ old('start_time') ?: '09:00:00' }}"
                >
            </div>
            @error('start_time')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="end_time">End Time</label>
                <input style="max-width: 10rem; @error('end_time') background-color: rgba(255,0,0,0.1) @enderror "
                       type="time"
                       name="end_time"
                       value="{{ old('end_time') ?: '23:00:00' }}"
                >
            </div>
            @error('end_time')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="ensemble_fee">Fee Per Ensemble</label>
                <input style="max-width: 10rem; @error('ensemble_fee') background-color: rgba(255,0,0,0.1) @enderror "
                       type="text"
                       name="ensemble_fee"
                       value="{{ old('ensemble_fee') ?: 400.00 }}"
                >
            </div>
            @error('ensemble_fee')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="max_soloists">Maximum # of Soloists</label>
                <input style="max-width: 10rem; @error('max_soloists') bac4ground-color: rgba(255,0,0,0.1) @enderror "
                       type="number"
                       name="max_soloists"
                       value="{{ old('max_soloists') ?: 4 }}"
                >
            </div>
            @error('max_soloists')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="max_concert">Maximum # of Concert Soloists</label>
                <input style="max-width: 10rem; @error('max_concert') bac4ground-color: rgba(255,0,0,0.1) @enderror "
                       type="number"
                       name="max_concert"
                       value="{{ old('max_concert') ?: 2 }}"
                >
            </div>
            @error('max_concert')
                <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="max_show">Maximum # of Jazz/Pop/Show Soloists</label>
                <input style="max-width: 10rem; @error('max_show') bac4ground-color: rgba(255,0,0,0.1) @enderror "
                       type="number"
                       name="max_show"
                       value="{{ old('max_show') ?: 2 }}"
                >
            </div>
            @error('max_show')
                <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group mt-4">
                <label for="submit"></label>
                <input style="background-color: black; color: white; max-width: 10rem"  class="rounded-full" type="submit" name="submit" value="Save">
            </div>

        </form>
