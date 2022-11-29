@props([
'active' => 'profile',
'user' => auth()->user(),
])
<nav class="m-6 flex flex-row justify-around text-md border border-blue-800 rounded">
    <a href="{{ route('users.accepteds.profiles.show', ['user' => $user]) }}"
       class="@if($active === 'profile') text-red-600 @else text-gray-400 @endif"
    >
        Profile
    </a>

    <a href="{{ route('user.about') }}"
       class="@if($active === 'school') text-red-600 @else text-gray-400 @endif"
    >
        School
    </a>

    <a href=""
       class="@if($active === 'students') text-red-600 @else text-gray-400 @endif"
    >
        Students
    </a>

    <a href="{{ route('user.contact') }}"
       class="@if($active === 'ensembles') text-red-600 @else text-gray-400 @endif"
    >
        Ensembles
    </a>

    <a href=""
       class="@if($active === 'soloists') text-red-600 @else text-gray-400 @endif"
    >
        Soloists
    </a>

    <a href=""
       class="@if($active === 'application') text-red-600 @else text-gray-400 @endif"
    >
        Application
    </a>
</nav>
