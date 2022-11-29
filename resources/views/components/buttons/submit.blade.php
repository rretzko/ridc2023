@props([
'value' => 'submit',
])
<style>
    input[type=submit]{background-color: black; color: white; padding:0 0.5rem; max-width: 10rem;border-radius: 1rem;}
</style>
<input type="submit" name="submit" value="{{ ucwords($value) }}" />
