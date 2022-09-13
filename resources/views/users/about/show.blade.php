<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application') }}
        </h2>
    </x-slot>

    {{-- EVENT LOGISTICS --}}
    <div id="event_logistics" class="text-center pt-6">
        <div style="font-size: 3rem; font-family: 'Brush Script MT'; font-style: italic; color: navy;">Roxbury Invitational</div>
        <div style="font-weight: bold; color: navy;">{{ \App\Models\CurrentEvent::currentEvent()->eventDateDMdY }}</div>
    </div>

    {{-- NAVIGATION --}}
    <x-navs.application />

        <div id="main" >

            <style>
                form{font-size: 1.3rem;}
                .input-group{display: flex; flex-direction: column; font-size: 1rem; margin-bottom: 0.25rem;}
                .input-group label{font-size: 1rem; min-width: 8rem;}
                .input-group input,select{border: 1px solid black; font-size: 1rem;}
                .input-group input{padding: 0.25rem;}
                .input-group select{font-size: 0.8rem;}
                @media only screen and (min-width:800px){
                    .input-group{display: flex; flex-direction: row; font-size: 1rem; margin-bottom: 0.25rem;}
                }
            </style>

            {{-- ABOUT THE INVITATIONAL  --}}
            <div class="justify-center p-6 border" style="">
                <h3 style="padding: 0; margin: 0; margin-bottom: 1rem;font-size: 1.25rem;">About The Invitational</h3>

                {{-- SUCCESS MESSAGE --}}
                @if(\Illuminate\Support\Facades\Session::has('success'))
                   <div style="padding: 0.25rem; border: 1px solid darkgreen; background-color: rgba(0,255,0,0.1); color: black;">
                       {!! \Illuminate\Support\Facades\Session::get('success') !!}
                   </div>
                @endif

                <style>
                    table{border-collapse: collapse; font-size: 1rem;}
                    td,th{border: 1px solid black; padding: 0 0.25rem;}
                    td{vertical-align: top;}
                    .odd{background-color: rgba(0,255,0,0.1);}
                </style>
                <table>
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Descriptions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\About::orderBy('order_by')->get() AS $about)
                        <tr class="@if($loop->odd) odd @endif">
                            <td class="title">{{ $about->title }}</td>
                            <td class="descr">{{ $about->descr }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>

        </div>

</x-app-layout>
