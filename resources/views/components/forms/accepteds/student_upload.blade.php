@props([

])
<x-forms.stylesheet />

<form method="post"
      action="{{ route('users.accepteds.students.store_upload') }}"
      enctype="multipart/form-data"
      class="border border-t-white mt-8 px-4 shadow-lg"
>

    @csrf

    {{-- ADVISORY --}}
    <div class="advisory bg-gray-300 px-4 rounded" class="text-sm" style="margin-bottom: 0.5rem;">
        <p>Use this form to upload student records.</p>
        <p>New student records will be added to your current roster.</p>
        <p><a href="{{ asset('assets\csvs\student_upload_template.csv') }}" class="text-blue-600">Click here to download the student_upload_template.csv!</a></p>
    </div>

    <div class="input-group mt-4">
        <label for="file">Upload <b><u>csv</u></b> file</label>
        <input id="file" accept="multipart/form-data" name="students" type="file" />
        {{-- ERRORS: File --}}
        @error('file')
        <div class="error-mssg">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="input-group mt-4">
        <label></label>
        <x-buttons.submit />
    </div>

</form>
