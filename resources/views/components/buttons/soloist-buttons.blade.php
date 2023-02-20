@props([
    'current' => '',
])
<div class="flex flex-row justify-end space-x-2 mr-12">
    <div class="@if($current === 'edit') hidden @endif">
        <a href="{{ route('admin.schedules.soloists.edit') }}">
            <button class="bg-indigo-200 rounded-full px-2 text-sm">
                Update Schedule
            </button>
        </a>
    </div>

    <div class="@if($current === 'show') hidden @endif">
        <a href="{{ route('admin.schedules.soloists.show') }}">
            <button class="bg-yellow-300 rounded-full px-2 text-sm">
                Daytime Schedule
            </button>
        </a>
    </div>

    <div class="@if($current === 'csv') hidden @endif">
        <a href="{{ route('admin.schedules.soloists.csv') }}">
            <button class="bg-fuchsia-300 rounded-full px-2 text-sm">
                Download Csv
            </button>
        </a>
    </div>

</div>
