<style>
    #event_logistics{
        background-color: rgba(255,0,0,0.0);
        color: gold;
        font-size: 1.5rem;
        left: 30%;
        position: absolute;
        text-align: center;
        top: 2px;
        width: 50%;
    }
    #event_date{
        font-size: 0.8rem;
        margin-top: -0.5rem;
    }
    @media screen and (min-width: 800px){
        #event_logistics{
            justify-content: center;
            display: flex;
            flex-direction: row;
            font-size: 2rem;
            left: 20%;
            top: 10px;
            width: 60%;
        }
        #event_date{
            font-size: 1rem;
            margin-top: 0.9rem;
            margin-left: 1rem;
        }
    }
    @media screen and (min-width: 1200px){
        #event_logistics{
            width: 60%;
            left: 25%;
            max-width: 800px;
        }
    }
    @media screen and (min-width: 1800px){
        #event_logistics{
            width: 60%;
            left: 30%;
            max-width: 800px;
        }
    }
    @media screen and (min-width: 2200px){
        #event_logistics{
            width: 60%;
            left: 33%;
            max-width: 800px;
        }
    }
</style>
<div id="event_logistics" class=" " style="">
    <div id="event_title"
        style=" font-family: 'Brush Script MT'; font-style: italic;"
    >
        Roxbury Invitational
    </div>
    <div id="event_date">
        {{ \App\Models\CurrentEvent::currentEvent()->eventDateDMdY }}
    </div>
</div>
