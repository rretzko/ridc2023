<div>
    <h1 style="text-align: center;">{{ $event->subtitle.' '.$event->title }} Invoice</h1>

    <h3>Director Information</h3>
    <style>
        label{min-width: 20%; text-align: left;}
        td{vertical-align: top;}
        .data{font-size: larger; font-weight: bold; text-align: left; padding-left: 1rem;}
        .data-row{margin-left: 3rem; min-width: 80%; max-width: 80%; display: flex; flex-direction: row;}
        .hint{font-size: small; font-weight: normal;}
        .spacer{height: 1rem;}
    </style>
    <table style="border-collapse: collapse;">
        {{-- USER NAME --}}
        <tr>
            <td class="label">Name:</td>
            <td class="data">{{ $application->userName }}</td>
        </tr>

        {{-- SPACER --}}
        <tr>
            <td class="spacer" colspan="2"></td>
        </tr>

        {{-- SCHOOL NAME --}}
        <tr>
            <td class="label">School:</td>
            <td class="data">{{ $application->schoolName }}</td>
        </tr>
        <tr>
            <td class="label">Address:</td>
            <td class="data">{!! $application->addressBlock !!}</td>
        </tr>

        {{-- SPACER --}}
        <tr>
            <td class="spacer" colspan="2"></td>
        </tr>

        {{-- EMAIL --}}
        <tr>
            <td class="label">Email:</td>
            <td class="data">{{ $application->email }}</td>
        </tr>

        {{-- CELL PHONE --}}
        <tr>
            <td class="label">Cell Phone:</td>
            <td class="data">{{ $application->phoneMobile }}</td>
        </tr>

        {{-- WORK PHONE --}}
        <tr>
            <td class="label">School Phone:</td>
            <td class="data">{{ $application->phoneWork }}</td>
        </tr>

        {{-- SPACER --}}
        <tr>
            <td class="spacer" colspan="2"></td>
        </tr>

        {{-- ENSEMBLES --}}
        <tr>
            <td class="label">Ensembles:</td>
            <td class="data">{!! $application->ensemblesBlock !!}</td>
        </tr>

        {{-- SPACER --}}
        <tr>
            <td class="spacer" colspan="2"></td>
        </tr>

        {{-- ATTENDINGS --}}
        <tr>
            <td class="label">Attendings:</td>
            <td class="data">
                Students: {{ $application->attending_students }}<br />
                Adults: {{ $application->attending_adults }}
            </td>
        </tr>

        {{-- SPACER --}}
        <tr>
            <td class="spacer" colspan="2"></td>
        </tr>

        {{-- PAYMENT --}}
        <tr>
            <td class="label">Payment:</td>
            <td class="data">
                ${{ number_format($application->payment_due,2) }}<br />
                <span class="hint">Checks made Payable to "Roxbury HS Choir"</span>
            </td>
        </tr>

    </table>

    <div style="margin: auto; margin-top: 2rem;  border: 1px solid black; padding: 0.5rem; background-color: rgba(0,0,0,0.1); font-weight: bold; text-align: center;" >
        <header>
            Return completed form with payment by November 9, 2024 to:
        </header>
        <div>Patrick Hachey</div>
        <div>1 Bryant Drive</div>
        <div>Succasunna, NJ 07876</div>
        <div>Phone: (973) 584-1200 x1250</div>
        <div>Fax: (973) 598-8266</div>
    </div>


</div>

