@if (Route::has('login'))
    <style>
        #choir{
            height: 50px;
            width: 100%;
        }

        #choir_img_header{
            margin-bottom: 0.25rem;
        }

        #logo{
            background-color: white;
            border-radius: 0.5rem;
            margin-left: 1rem;
            padding: 0.25rem;
        }

        #logo img
        {
            height: 24px;
            max-height: 24px;
        }

        .menu_site_ribbon
        {
            background-color: rgba(0,0,0,0.5);
            position: absolute;
            top: 1rem;
            width: 96%;
            display: flex;
            justify-content: space-between;
        }

        .menu_site_ribbon a{
            color: lime;
            font-size: xx-small;
            margin-right: 1rem;
        }

        @media screen and (min-width: 800px){

            #choir{
                height: 100px;
            }

            #main{
                font-size: 1.3rem;
            }

            .menu_site_ribbon a{
                font-size: large;
            }
        }

        @media  screen and (min-width: 1200px) {

            #choir{
                height: 150px;
            }

            .menu_site_ribbon {
                max-width: 1200px;
            }
        }

    </style>

    <header id="choir_img_header">
        <img id="choir" src="{{ asset('assets/images/roxInvitationalBanner.png') }}" alt="Roxbury Choir banner" />
    </header>

    {{-- MENU SITE RIBBON --}}
    <div class="menu_site_ribbon">

        {{-- LOGO --}}
        <a href="{{ auth()->user() ? 'dashboard' : 'guest.home'   }}" >
            <div id="logo" >
                    <img src="{{ asset('assets/images/ridc_logo.png') }}" alt="Roxbury Choir logo" />
            </div>
        </a>

        {{-- USER MASTER NAV --}}
        <div>
            @guest
                <a href="{{ route('login') }}" >LogIn</a>

               <!-- {{-- <a href="{{ route('register') }}" >Register</a> --}} -->
            @endguest

            @auth
               <x-navs.user_dropdown />
            @endauth

        </div>

    </div>

@endif
