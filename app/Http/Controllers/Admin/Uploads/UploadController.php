<?php

namespace App\Http\Controllers\Admin\Uploads;

use App\Http\Controllers\Controller;
use App\Models\Adjudicator;
use App\Models\Event;
use App\Models\EventEnsemble;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all()->sortByDesc('id');

        $target = $events->first();

        $adjudicators = $target->adjudicators;
        $ensembles = $target->ensembles;
        $schools = $target->schools;

        $daytime = (Carbon::now()->format('G') < 17);

        return view('admin.uploads.index', [
            'adjudicators' => $adjudicators,
            'admin_active' => 'uploads',
            'daytime' => $daytime,
            'ensembles' => $ensembles,
            'events' => $events,
            'schools' => $schools,
        ]);
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
        $inputs = $request->validate(
            [
                'daytime' => ['required', 'min:0', 'max:1'],
                'event_id' => ['required', 'exists:events,id'],
                'school_id' => ['required', 'exists:schools,id'],
                'ensemble_id' => ['required', 'exists:ensembles,id'],
                'adjudicator_id' => ['required', 'exists:adjudicators,id'],
                'partial' => ['required', 'min:1', 'max:4'],
            ]
        );

        if ($request->hasFile('recording')) {

            $file = $request->file('recording');
            $hashname = $file->hashName();

            //ex. "ridc/38/1/40/6/1/"
            $directory = 'ridc/' . $inputs['event_id'] . '/' . $inputs['school_id'] . '/' . $inputs['daytime'] . '/' . $inputs['ensemble_id'] . '/' . $inputs['adjudicator_id'] . '/' . $inputs['partial'] . '/';

            //store recording in DigitalOcean Spaces
            $file->storePublicly($directory, 'spaces');

            //reference the storage in the database
            \App\Models\FileUpload::updateOrCreate(
                [
                    'event_id' => $inputs['event_id'],
                    'school_id' => $inputs['school_id'],
                    'portion' => $inputs['daytime'],
                    'ensemble_id' => $inputs['ensemble_id'],
                    'adjudicator_id' => $inputs['adjudicator_id'],
                    'partial' => $inputs['partial'],
                    'url' => $directory . $hashname,
                ],
                [
                    'uploaded_by' => auth()->id(),
                ]
            );
        } else {
            session()->flash('fileError', 'no file found');
        }

        return $this->index();
    }

    /**
     * Seed Spaces with previous event recordings
     */
    public function seed()
    {
        foreach($this->makeSeeds() AS $seed){

        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function makeSeeds(): array
    {
        $seeds = [
            [
                'filename' => 'https://rickretzko.com/roxburyinvitational.com/public_html/recordings/day_1553517792.mp3',
                'hashname' => 'day_1553517792.mp3',
                'directory' => 'ridc/29/16/32/17/1/',
            ]
        ];

        //$directory = 'ridc/' . $inputs['event_id'] . '/' . $inputs['school_id'] . '/' . $inputs['ensemble_id'] . '/' . $inputs['adjudicator_id'] . '/' . $inputs['partial'] . '/';


        return $seeds;
    }
}
