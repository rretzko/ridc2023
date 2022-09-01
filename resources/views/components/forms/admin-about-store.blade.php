<style>
    .input-group{margin-bottom: 0.25rem; margin-left: 0.5rem;display: flex; flex-direction: column;}
    label{margin-left: 0.5rem;}
    .verror{margin-left: 0.5rem; border: 1px solid darkred; color: red; padding: 0 0.25rem; font-size: 0.8rem;}
</style>

        <form method="post" action="{{ route('admin.about.store') }}" >

            @csrf

            <h2>Add a new section</h2>

            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       style="@error('title') background-color: rgba(255,0,0,0.1) @enderror"
                       value="{{ old('title') }}"
                />
            </div>
            @error('title')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="descr">Description</label>
                <textarea rows="5" name="descr" style="@error('descr') background-color: rgba(255,0,0,0.1) @enderror" >{{ old('descr') }}</textarea>
            </div>
            @error('descr')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <label for="order_by">Order</label>
                <input style="max-width: 5rem; @error('order_by') background-color: rgba(255,0,0,0.1) @enderror " type="number" name="order_by" value="{{ old('order_by') ?: 1 }}">
            </div>
            @error('order_by')
            <div class="verror">{{ $message }}</div>
            @enderror

            <div class="input-group mt-4">
                <label for="submit"></label>
                <input style="background-color: black; color: white; max-width: 10rem"  class="rounded-full" type="submit" name="submit" value="Save">
            </div>

        </form>
