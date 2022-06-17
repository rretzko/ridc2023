<style>
    #instructions, button, button .value, h2, header{font-size: 0.8rem;}
    #instructions{
        background-color: rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.5);
        border-radius: 0.5rem;
        margin: auto;
        margin-top: 1rem;
        padding: 0.5rem;
        width: 80%;
    }

    #instructions header{font-weight: bold;}
    @media screen and (min-width: 800px){
        #instructions, button, button .value, h2, header{font-size: 1.3rem;}
    }
</style>

<div id="instructions">
    {{ $slot }}
</div>
