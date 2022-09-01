@props(
[
    'abouts' => $abouts
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
            <th>Title</th>
            <th>Description</th>
            <th class="sr-only">Edit</th>
        </tr>
        </thead>
        <tbody>
        @forelse($abouts AS $about)
            <tr style="{{ $loop->odd ? 'background-color: rgba(0,255,0,0.1)' : '' }}">
                <td class="text-center">{{ $about->order_by }}</td>
                <td>{{ $about->title }}</td>
                <td>{{ $about->descr }}</td>
                <td class="align-middle">
                    <a href="{{ route('admin.about.edit', $about) }}">
                        <button class="border border-white rounded-full px-2 bg-indigo-600 text-white">
                            Edit
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
