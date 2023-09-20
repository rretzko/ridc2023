<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\Utility\Application;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ApplicationController extends Controller
{
    public function edit()
    {
        $application = new Application;
        $event = CurrentEvent::currentEvent();

        return view('users.application.edit', compact('application','event'));
    }

    public function update(ApplicationRequest $request)
    {

        $service = new ApplicationService($request->validated());

        return redirect()->route('user.application.edit')->with('success','Application updated!');
    }

    public function destroy(Ensemble $ensemble)
    {

        $success = 'Ensemble: "'.$ensemble->ensemble_name.'" successfully removed.';

        $this->destroyEventEnsemble($ensemble);

        $ensemble->delete();

        $this->mustHavePrimaryEventEnsemble();

        return redirect()->route('user.application.edit')->with('success',$success);
    }

    public function pdf()
    {
        $application = new Application;

        $invoice = PDF::loadView('users.pdfs.invoice',
            [
                'application' => $application,
                'event' => CurrentEvent::currentEvent(),
            ])
            ->setPaper('letter','portrait');

        session()->flash('success', 'Application PDF downloaded.');

        return $invoice->download('RoxburyInvitationalInvoice.pdf');
        /**
         * $event = Event::getCurrentEvent();
        $feecategory = $event->feeCategory;

        $membershipstatusservice = new \App\Services\MembershipStatusService(auth()->user());
        $ismember = $membershipstatusservice->isMember();
        $level = $membershipstatusservice->level();
        $student = $membershipstatusservice->student();

        if(RegistrationfeeUser::where('event_id', Event::getCurrentEvent()->id)
        ->where('user_id', auth()->id())
        ->exists()){

        $rfu = RegistrationfeeUser::where('event_id', Event::getCurrentEvent()->id)->where('user_id', auth()->id())->first();
        $rf = Registrationfee::find($rfu->registrationfee_id);
        $registrationfee = $rf->fee;

        $presenterdiscount = (auth()->user()->isPresenter)
        ? number_format(($registrationfee / 2), 2)
        : 0;

        }else {
        $calc = new EventRegistrationFeeService($event, $feecategory, $level, $ismember, $student);
        $registrationfee = $calc->fee();
        }

        $presenterdiscount = (auth()->user()->isPresenter)
        ? number_format(($registrationfee / 2), 2)
        : 0;

        $readingsessions = auth()->user()->presentations->sortBy('title')->values();
        $readingsessionsfee = (($readingsessions->count() - 2) * 12);

        $due = ($registrationfee + $readingsessionsfee - $presenterdiscount);
        $paid = Payment::where('user_id', auth()->id())->where('event_id', $event->id)->sum('amount');
        $balance = ($due - $paid);

        $invoice = PDF::loadView('registrants.pdfs.invoice',
        [
        'balance' => $balance,
        'due' => $due,
        'event' => Event::getCurrentEvent(),
        'paid' => $paid,
        'presenterdiscount' => $presenterdiscount,
        'registrationfee' => $registrationfee,
        'readingsessions' => $readingsessions,
        'readingsessionsfee' => $readingsessionsfee,

        ])
        ->setPaper('letter','portrait');

        return $invoice->download('MySummerConferenceInvoice.pdf');
         */


    }

    /** END OF PUBLIC FUNCTIONS  *********************************************/

    private function destroyEventEnsemble(Ensemble $ensemble): void
    {
        $currenteventid = CurrentEvent::currentEvent()->id;
        $eventensembles = EventEnsemble::where('event_id', $currenteventid)->get();

        if($eventensembles->contains('ensemble_id',$ensemble->id)){

            EventEnsemble::where('event_id',$currenteventid)
                ->where('ensemble_id', $ensemble->id)
                ->delete();
        }
    }

    private function mustHavePrimaryEventEnsemble(): void
    {
        $currenteventid = CurrentEvent::currentEvent()->id;
        $eventensembles = EventEnsemble::where('event_id', $currenteventid)->get();

        if($eventensembles->count() && (! $eventensembles->contains('primary',1))){

            //make the first item in the collection into the Primary ensemble
            $eventensembles->first()->update(['primary' => 1]);
        };
    }
}
