@props([
    'action',
    'ensemble',
])
<style>
    #tabs{display:flex;flex-direction: row;}
    .tab{background-color: white; padding:0 0.5rem; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; box-shadow: 4px 0px 10px darkgrey; margin-right: 4px;}
    .descr-short{display:block;}
    .descr-wide{display:none;}
    @media screen and (min-width: 600px){
        #tabs{ display:flex; flex-direction: row; justify-content: start;}
        .descr-short{display:none;}
        .descr-wide{display: block;}
    }
</style>
<div id="tabs" style="border-bottom: 1px solid lightgrey; margin-bottom: 0.5rem; ">
    <div class="tab @if($action == 'descr') text-blue-600 @endif" style="margin-left: 1rem;">
        <span class="descr-short">Desc</span>
        <span class="descr-wide">Description</span>
    </div>

    <div class="tab @if($action == 'intro') text-blue-600 @endif ">
        Intro
    </div>

    <div class="tab @if($action == 'rep') text-blue-600 @endif ">
        <span class="descr-short">Rep</span>
        <span class="descr-wide">Repertoire</span>
    </div>

    <div class="tab @if($action == 'setup') text-blue-600 @endif ">
        Set-Up
    </div>

</div>
