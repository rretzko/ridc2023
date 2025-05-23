@props([
    'ensemble',
])
<div>
    <x-forms.stylesheet />
    <form method="post" action="{{ route('users.ensembles.description', ['ensemble' => $ensemble]) }}" >

        @csrf

        <div class="">
            Type: <b>{{ ucwords($ensemble->category->descr) }}</b>
        </div>

        <div class="input-group">
            <label for="ensemble_name">Name</label>
            <input type="text" name="ensemble_name" value="{{ $ensemble->ensemble_name }}" />
        </div>

        <div class="input-group">
            <label for="directed_by">Directed By</label>
            <input type="text" name="directed_by" value="{{ $ensemble->directed_by }}" />
        </div>

        <div class="input-group">
            <label for="descr">Description</label>
            <textarea col="40" rows="12" name="descr">{{ $ensemble->descr }}</textarea>
            @error('descr')
                <div style="color: red; margin-top: 0.5rem; margin-left: 0.5rem; font-size: smaller;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <x-buttons.submit />
    </form>
</div>
