@props([
'class_ofs',
'student',
])
<x-forms.stylesheet />

<form method="post" action="{{ route('users.accepteds.students.update', $student) }}" >

    @csrf
    <div class="input-group">
        <label for="first">Name</label>
        <div class="col2row">
            {{-- FIRST NAME --}}
            <input
                class="col2row @error('first') bg-red-50 @enderror"
                type="text"
                name="first"
                value="{{ old('first') ?: $student->first }}"
                placeholder="First name"
                required
            />

            {{-- ERRORS: First, Middle, and Last Names --}}
            @error('first')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror
            @error('middle')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror
            @error('last')
            <div class="error-mssg">
                {{ $message }}
            </div>
            @enderror

            {{-- MIDDLE NAME --}}
            <input
                class="col2row @error('middle') bg-red-50 @enderror"
                type="text"
                name="middle"
                value="{{ old('middle') ?: $student->middle }}"
                placeholder="Middle name"/>

            {{-- LAST NAME --}}
            <input
                class="col2row @error('last') bg-red-50 @enderror"
                type="text"
                name="last"
                value="{{ old('last') ?: $student->last }}"
                placeholder="Last name" required />
        </div>

        <div class="input-group">
            <label for="class_of">Grade (Class)</label>
            <select name="class_of" class="short-text">
                @foreach($class_ofs AS $class_of => $descr)
                    <option value="{{ $class_of }}"
                        @if($class_of == $student->class_of) selected @endif
                    >
                        {{ $descr }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>


    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
