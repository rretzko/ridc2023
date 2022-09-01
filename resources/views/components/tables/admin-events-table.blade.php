@props(
[
    'events' => $events
]
)

<div>
    <style>
        td, th {
            border: 1px solid black;
            padding: 0 0.25rem;
            vertical-align: top;
            font-size: 1rem;
        }
    </style>
    <table>
        <thead>
        <tr>
            <th>Order</th>
            <th>Titles</th>
            <th class="hidden md:table-cell">Dates<br /><span class="text-sm">(open/close/event)</span></th>
            <th class="hidden md:table-cell">Times<br /><span class="text-sm">(start/end)</span></th>
            <th class="hidden md:table-cell">Max #<br /><span class="text-sm">(soloists/concert/show)</span></th>
            <th class="sr-only">Edit</th>
            <th class="sr-only">Remove</th>
        </tr>
        </thead>
        <tbody>
        @forelse($events AS $event)
            <tr style="{{ $loop->odd ? 'background-color: rgba(0,255,0,0.1)' : '' }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $event->title }}<br />
                    {{ $event->subtitle }}<br />
                    {{ $event->descr }}</td>
                <td class="hidden md:table-cell">{{ $event->open_date }}<br />
                    {{ $event->close_date }}<br />
                    {{ $event->event_date }}</td>
                <td class="hidden md:table-cell">{{ $event->start_time }}<br />
                    {{ $event->end_time }}</td>
                <td class="hidden md:table-cell text-center">{{ $event->max_soloists }}<br />
                    {{ $event->max_concert }}<br />
                    {{ $event->max_show }}
                </td>
                <td class="align-middle">
                    <a href="{{ route('admin.events.edit', $event) }}">
                        <button class="border border-white rounded-full px-2 bg-indigo-600 text-white">
                            Edit
                        </button>
                    </a>
                </td>
                <td class="align-middle">
                    <a href="{{ route('admin.events.destroy', $event) }}">
                        <button class="border border-white rounded-full px-2 bg-red-700 text-white">
                            Remove
                        </button>
                    </a>
                </td>
            </tr>
        @empty
            <td class="text-center" colspan="3">No entries found</td>
        @endforelse
        </tbody>
    </table>
</div>
