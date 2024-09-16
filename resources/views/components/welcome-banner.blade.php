<style>
    #welcome{
        background-color: midnightblue;
        border-radius: 1rem;
        color: gold;
        font-family: "Times New Roman";
        font-weight: bold;
        margin-bottom: 0.25rem;

        padding: 0.5rem 0;
        text-align: center;
    }

    #welcome #event_date{
        font-size: larger;
        text-transform: uppercase;
    }

    #welcome .locale{
        font-size: smaller;
    }

</style>
<div id="welcome">
    <header>
        Welcome to the Roxbury Invitational Website!
    </header>
    <div>
        {{ \App\Models\CurrentEvent::currentEvent()->subtitle }}
    </div>
    <div>
        Concert, Show, Jazz and Pop Choir Invitational
    </div>
    <div id="event_date">
        {{ \App\Models\CurrentEvent::currentEvent()->eventDateDMdY }}
    </div>
    <div class="locale">
        Roxbury High School
    </div>
    <div class="locale">
        Succasunna, NJ 07876
    </div>
</div>
