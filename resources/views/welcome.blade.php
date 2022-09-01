<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Roxbury Invitational</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            @media screen and (min-width: 1200px){
                #main{
                    margin: auto;
                    max-width: 1200px;
                }
            }
        </style>
    </head>
    <body class="antialiased" style="padding: 0.5rem;">

        <div id="main" >
            {{-- GUEST PAGE HEADER --}}
            <x-headers.guest_header />


            {{-- MAIN NAVIGATION MENU --}}
            <x-navs.guest_nav />

            {{-- WELCOME EVENT HEADER --}}
            <x-welcome-banner />

            {{-- INVITATION  --}}
            <div id="invitation" style="color: black; display: flex; flex-direction: column; text-align: center; margin: 1rem 0; padding: 0 1rem;">
                <header style="font-weight: bold; font-family: 'Times New Roman';">
                    Thank you for your interest in our 31st Annual Concert, Show, Jazz and Pop Choir Invitational!
                </header>
                <div>
                    It is very exciting for us to host a festival of this nature, and we are thrilled at your interest in joining us!
                </div>
                <div>
                    If you have <b><i>not</i></b> participated in the past, please <a href="{{ route('guest.contact') }}" style="color:blue">click here</a> to let us know of your interest!
                </div>
            </div>

            {{-- FESTIVAL SCHEDULE --}}
            <style>
                ul{
                    font-size: medium;
                    list-style-type: disc;
                    margin-left: 0%;
                    text-align: left;
                }
                li.list-even{
                    color: white;
                }
                li.list-odd{
                    color: powderblue;
                }
                #schedule{
                    background-color: navy;
                    border-radius: 1rem;
                    padding: 0.5rem 0;
                }

                #schedule header{
                    color: white;
                    font-weight: bold;
                    text-transform: uppercase;
                }

                @media screen and (min-width: 600px){
                    ul{
                        margin-left: 20%;
                    }
                }

                @media screen and (min-width: 800px){
                    ul{
                        margin-left: 25%;
                    }
                }

                @media screen and (min-width: 1180px){
                    ul{
                        margin-left: 33%;
                    }
                }

            </style>
            <div id="schedule" style="text-align: center;">
                <header>
                    Here's our Festival schedule:
                </header>
                <div id="schedule_list">
                    <ul>
                        <li class="list-even">Invitation Phase: early-October</li>
                        <li class="list-odd">Application Phase: early-October - November</li>
                        <li class="list-even">Selection Phase: mid-November</li>
                        <li class="list-odd">Acceptance Phase: mid-December</li>
                        <li class="list-even">Program Completion Phase: mid-December - March 1, 2023</li>
                        <li class="list-odd">Festival: Saturday, March 24, 2023</li>
                    </ul>
                </div>
            </div>

            {{-- CONTACT --}}
            <div id="contact" style="margin: 1rem 0; text-align: center;">
                If you have any questions, feel free to <a href="{{ route('guest.contact') }}" style="color: blue;">send me an email</a>, call me at 973-584-1200 x1250 or fax me at 973-584-7854.
            </div>

            {{-- HOSTS --}}
            <style>

                #hosts .host{
                    border-radius: 1rem;
                    box-shadow: 4px 4px 10px darkgrey;
                    font-size: medium;
                    padding: 0.25rem 0.5rem;
                    text-align: center;
                }

                #hosts .host header{
                    font-family: "Brush Script MT";

                }

                #hosts .host .school{
                    font-size: xx-small;
                }

                #hosts .host .title{
                    font-size: xx-small;
                }

                @media screen and (min-width: 800px){

                    #hosts .host{
                        font-size: 1.5rem;
                    }

                    #hosts .host .school, #hosts .host .title{
                        font-size: small;
                    }
                }

            </style>
            <div id="hosts" style="margin: 1rem 0; display: flex; flex-direction: row; justify-content: space-around;">

                <div class="host">
                    <header>
                        Patrick Hachey
                    </header>
                    <div class="title">
                        Director of Choral Activities
                    </div>
                    <div class="school">
                        Roxbury High School
                    </div>
                </div>

                <div class="host">
                    <header>
                        R. Dan Salyerds
                    </header>
                    <div class="title">
                        Assistant Choir Director
                    </div>
                    <div class="school">
                        Roxbury High School
                    </div>
                </div>

                <div class="host">
                    <header>
                        Krista Sweer
                    </header>
                    <div class="title">
                        Associate Choir Director
                    </div>
                    <div class="school">
                        Roxbury High School
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
