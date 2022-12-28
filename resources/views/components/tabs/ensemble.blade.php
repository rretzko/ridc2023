@props([
    'action',
    'ensemble',
])
<style>
    #tabs{display:flex;flex-direction: row;}
    .tab{background-color: rbga(0,0,0,0.1); padding:0 0.5rem; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; box-shadow: 4px 0px 10px darkgrey; margin-right: 4px;}
    .tab_active{background-color: white; padding:0 0.5rem; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; box-shadow: 4px 0px 10px darkgrey; margin-right: 4px;}
    .descr-short{display:block;}
    .descr-wide{display:none;}
    @media screen and (min-width: 600px){
        #tabs{ display:flex; flex-direction: row; justify-content: start;}
        .descr-short{display:none;}
        .descr-wide{display: block;}
    }
</style>
<div id="tabs" style="border-bottom: 1px solid lightgrey; margin-bottom: 0.5rem; ">

    {{-- DESCRIPTION --}}
    <div class="@if($action == 'descr') tab_active @else tab @endif" style="margin-left: 1rem;">
        <span class="descr-short">
             <a href="{{ route('users.ensembles.edit', ['ensemble' => $ensemble, 'action' => 'descr']) }}"">
                Descr
            </a>
        </span>
        <span class="descr-wide ">
            <a href="{{ route('users.ensembles.edit', ['ensemble' => $ensemble, 'action' => 'descr']) }}">
                Description
            </a>
        </span>
    </div>

    {{-- REMOVED INTRO TAB PER HACHEY 28-DEC-2022 EMAIL --}}
    {{--
    <div class="tab @if($action == 'intro') text-blue-600 @endif ">
        Intro
    </div>
    --}}

    {{-- REPERTOIRE --}}
    <div class="@if($action == 'rep') tab_active @else tab @endif ">
        <span class="descr-short">
              <a href="{{ route('users.repertoire.index', ['ensemble' => $ensemble]) }}">
                Rep
              </a>
        </span>
        <span class="descr-wide">
            <a href="{{ route('users.repertoire.index', ['ensemble' => $ensemble]) }}">
                Repertoire
            </a>
        </span>
    </div>

    <div class="@if($action == 'setup') tab_active @else tab @endif ">
        Set-Up
    </div>

</div>
