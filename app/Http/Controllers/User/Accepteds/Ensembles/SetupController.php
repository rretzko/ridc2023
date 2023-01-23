<?php

namespace App\Http\Controllers\User\Accepteds\Ensembles;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\Setup;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function show(Setup $setup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ensemble $ensemble
     * @return \Illuminate\Http\Response
     */
    public function edit(Ensemble $ensemble)
    {
        $event = CurrentEvent::currentEvent();

        //find or create a Setup model
        $setup = Setup::firstOrCreate(
            [
                'ensemble_id' => $ensemble->id,
                'event_id' => CurrentEvent::currentEvent()->id,
                'category_id' =>  $ensemble->category->id,
                ],
                []
            );

        $user = auth()->user();
        $school = $user->school();

        return ($ensemble->category->descr === 'concert')
            ? view('users.accepteds.ensembles.setups.concert',
                compact('ensemble','event', 'school', 'setup', 'user'))
            : view('users.accepteds.setups.showpopjazz',
                compact('ensemble','event', 'school', 'setup', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setup $setup)
    {
        $inputs = ($setup->category_id == Category::where('descr', 'concert')->first()->id)
            ? $this->updateConcert($request, $setup)
            : $this->updateShowpopjazz($request, $setup);

        $setup->update($inputs);

        session()->flash('success', 'The set-up has been updated.');

        return $this->edit(Ensemble::find($setup->ensemble_id));
    }

    public function updateConcert(Request $request, Setup $setup)
    {
        return $request->validate(
            [
                'piano' => ['required','integer','min:0','max:1'],
            ]
        );
    }

    public function updateShowpopjazz(Request $request, Setup $setup)
    {
        return $request->validate(
            [
                'accompaniment' => ['required','string'],
                'amp' => ['required','integer','min:0','max:1'],
                'band_award' => ['required','string'],
                'drumset' => ['required','integer','min:0','max:1'],
                'instructions' => ['nullable','string'],
                'instrumentation' => ['nullable','string'],
                'microphone' => ['required','string'],
                'piano' => ['required','integer','min:0','max:1'],
                'platform' => ['required', 'string'],
                'props' => ['nullable','string'],
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setup $setup)
    {
        //
    }
}
