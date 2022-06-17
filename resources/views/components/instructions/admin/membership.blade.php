<div style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-around">

    {{-- INVITE --}}
    <div x-data="{invite: false}"
         role="region"
         class="rounded-lg shadow mt-1"
         style="background-color: lemonchiffon; border: 1px solid brown; color: brown;"
    >
        <h2>
            <button
                @click="invite = !invite"
                :aria-expanded="invite"
                class="flex items-center justify-between w-full font-bold px-2"
            >
                <span class="value">Invite</span>
                <span x-show="invite" aria-hidden="true" class="ml-4 value">&minus;</span>
                <span x-show="!invite" aria-hidden="true" class="ml-4 value">&plus;</span>
            </button>
        </h2>

        <div x-show="invite"
             class="pb-4 px-6"
             x-transition.duration.500ms
        >
            <ul class="ml-12 list-disc">
                <li>Click the 'Invite' yellow button to queue an invitation email.</li>
                <li>The yellow button will turn brown when an invitation is pending or has been sent.</li>
                <li>Float over the brown 'Invited' button to see the pending status or date(s) the invitation was sent.</li>
                <li>Click the 'Invited' button to re-queue an invitation.</li>
            </ul>
        </div>
    </div>

    {{-- ACCEPT --}}
    <div x-data="{accept: false}"
         role="region"
         class="rounded-lg shadow mt-1"
         style="background-color: rgba(0,255,0,0.1); border: 1px solid darkgreen; color: darkgreen;"
    >
        <h2>
            <button
                @click="accept = !accept"
                :aria-expanded="accept"
                class="flex items-center justify-between w-full font-bold px-2"
            >
                <span class="value">Accept</span>
                <span x-show="accept" aria-hidden="true" class="ml-4 value">&minus;</span>
                <span x-show="!accept" aria-hidden="true" class="ml-4 value">&plus;</span>
            </button>
        </h2>

        <div x-show="accept"
             class="pb-4 px-6"
             x-transition.duration.500ms
        >
            <ul class="ml-12 list-disc">
                <li>Click the 'Invite' yellow button to send an invitation.</li>
                <li>The yellow button will turn brown when an invitation has been sent.</li>
                <li>Float over the brown 'Invited' button to see the date the invitation was sent.</li>
                <li>Click the 'Invited' button to re-send an invitation.</li>
            </ul>
        </div>
    </div>

    {{-- REMOVE --}}
    <div x-data="{remove: false}"
         role="region"
         class="rounded-lg shadow mt-1"
         style="background-color: rgba(255,0,0,0.1); border: 1px solid darkred; color: darkred;"
    >
        <h2>
            <button
                @click="remove = !remove"
                :aria-expanded="remove"
                class="flex items-center justify-between w-full font-bold px-2"
            >
                <span class="value">Remove</span>
                <span x-show="remove" aria-hidden="true" class="ml-4 value">&minus;</span>
                <span x-show="!remove" aria-hidden="true" class="ml-4 value">&plus;</span>
            </button>
        </h2>

        <div x-show="remove"
             class="pb-4 px-6"
             x-transition.duration.500ms
        >
            <ul class="ml-12 list-disc">
                <li>Click the 'Invite' yellow button to send an invitation.</li>
                <li>The yellow button will turn brown when an invitation has been sent.</li>
                <li>Float over the brown 'Invited' button to see the date the invitation was sent.</li>
                <li>Click the 'Invited' button to re-send an invitation.</li>
            </ul>
        </div>
    </div>

    {{-- EMAILS --}}
    <div x-data="{emails: false}"
         role="region"
         class="rounded-lg shadow mt-1"
         style="background-color: rgba(0,0,0,0.8); border: 1px solid black; color: white;"
    >
        <h2>
            <button
                @click="emails = !emails"
                :aria-expanded="emails"
                class="flex items-center justify-between w-full font-bold px-2"
            >
                <span class="value">Emails</span>
                <span x-show="emails" aria-hidden="true" class="ml-4 value">&minus;</span>
                <span x-show="!emails" aria-hidden="true" class="ml-4 value">&plus;</span>
            </button>
        </h2>

        <div x-show="emails"
             class="pb-4 px-6"
             x-transition.duration.500ms
        >
            <ul class="ml-12 list-disc">
                <li>
                    <a href="{{ route('admin.pendingemails') }}" style="color: yellow;">Click here</a> to review currently pending emails!
                </li>
            </ul>
        </div>
    </div>
</div>

