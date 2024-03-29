@props([
'active' => 'profile',
'user' => auth()->user(),
])
<style>
    .nav-item{padding:0 0.25rem; }
    .nav-item:hover{color: blue;}
    .nav-item-first{ }
</style>
<nav class="m-6 text-md border border-blue-800 rounded">

    <div class="flex flex-wrap justify-around text-center">

        @if( auth()->user()->accepted())

            <a href="{{ route('users.accepteds.profiles.show', ['user' => $user]) }}"
               class="nav-item nav-item-first @if($active === 'profile') text-red-600 @else text-gray-400 @endif hover:text-gray-700"
            >
                Profile
            </a>

            <a href="{{ route('users.accepteds.schools.show') }}"
               class="nav-item @if($active === 'school') text-red-600 @else text-gray-400 @endif"
            >
                School
            </a>

            <a href="{{ route('users.accepteds.students.index') }}"
               class="nav-item @if($active === 'students') text-red-600 @else text-gray-400 @endif"
            >
                Students
            </a>

            <a href="{{ route('users.accepteds.ensembles.index') }}"
               class="nav-item @if($active === 'ensembles') text-red-600 @else text-gray-400 @endif"
            >
                Ensembles
            </a>


            <a href="{{ route('users.accepteds.soloists.index') }}"
               class="nav-item @if($active === 'soloists') text-red-600 @else text-gray-400 @endif"
            >
                Soloists
            </a>

            <a href="{{ route('users.accepteds.judging.show') }}"
               class="nav-item @if($active === 'judging') text-red-600 @else text-gray-400 @endif"
            >
                Judging
            </a>
        @endif

        <a href="{{ route('users.accepteds.application.show') }}"
           class="nav-item @if($active === 'application') text-red-600 @else text-gray-400 @endif"
        >
            Application
        </a>

    </div>

</nav>
