@props([
'roster_active' => false,
])

<style>
    #roster_menu_items{background-color: #2563eb; border-top: 1px solid white;}
    #roster_menu_items a:hover{color:yellow;}
    .roster_active{ color: yellow;}
</style>
<div id="roster_menu_items" class="flex flex-row justify-around">

    {{-- GENERAL MEMBERSHIP --}}
    <div class="">
        <a href="{{ route('admin.rosters.membership') }}"
           class="{{ ($roster_active && ($roster_active === 'membership')) ? 'roster_active' : 'text-white' }}"
        >
            Membership
        </a>
    </div>

    {{-- APPLICANTS --}}
    <div class="">
        <a href="{{ route('admin.rosters.applicants') }}"
           class="{{ ($roster_active && ($roster_active === 'applicants')) ? 'roster_active' : 'text-white' }}"
        >
            Applicants
        </a>
    </div>

    {{-- INVITEES --}}
    <div class="">
        <a href="{{ route('admin.rosters.invitations') }}"
           class="{{ ($roster_active && ($roster_active === 'invitees')) ? 'roster_active' : 'text-white' }}"
        >
            Invitees
        </a>
    </div>

    {{-- ACCEPTEDS --}}
    <div class="">
        <a href="{{ route('admin.rosters.accepteds') }}"
           class="{{ ($roster_active && ($roster_active === 'accepteds')) ? 'roster_active' : 'text-white' }}"
        >
            Accepteds
        </a>
    </div>
</div>
