@props([
    'admin_active' => false,
])
<style>
    #admin_menu_items{background-color: navy;}

    #admin_menu_items a:hover{color:yellow;}
    .admin_active{color: yellow;}
</style>

<div id="admin_menu_items" class="flex flex-row flex-wrap justify-around mx-2 ">

    {{-- EMAILS --}}
    <div class="">
        <a href="{{ route('admin.pendingemails') }}"
           class="{{ ($admin_active && ($admin_active === 'emails')) ? 'admin_active' : 'text-white' }}"
           title="{{ \App\Models\Pendingemail::all()->count() }} pending emails"
        >
            Emails
        </a>
    </div>

    {{-- DOWNLOADS --}}
    <div class="">
        <a href=""

           class="{{ ($admin_active && ($admin_active === 'downloads')) ? 'admin_active' : 'text-white' }}"
        >
            Downloads
        </a>
    </div>

    {{-- ROSTERS --}}
    <div class="">
        <a href="{{ route('admin.rosters') }}"
            class="{{ ($admin_active && ($admin_active === 'rosters')) ? 'admin_active' : 'text-white' }}"
        >
            Rosters
        </a>
    </div>

    {{-- SCHEDULES --}}
    <div class="">
        <a href=""

            class="{{ ($admin_active && ($admin_active === 'schedules')) ? 'admin_active' : 'text-white' }}"
        >
            Schedules
        </a>
    </div>

    {{-- UPLOADS --}}
    <div class="">
        <a href=""

            class="{{ ($admin_active && ($admin_active === 'uploads')) ? 'admin_active' : 'text-white' }}"
        >
            Uploads
        </a>
    </div>
</div>
