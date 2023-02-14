<?php

namespace App\Http\Controllers\Admin\Schedules;

use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\Tables\DaytimeEnsemblesTable;
use App\Models\Tables\EnsemblesTable;
use App\Models\Utility\Timeslot;
use Illuminate\Http\Request;

class EnsembleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = new EnsemblesTable;

        return view('admin.schedules.ensembles.index', ['admin_active' => 'schedules', 'table' => $table->table()]);
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
     * Display a read-only view of ensemble schedule including 'breaks' where no ensemble is scheduled
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $daytimeTable = new DaytimeEnsemblesTable('2023-03-25 09:00:00','2023-03-25 17:00:00',20);
        $table = $daytimeTable->table();

        $admin_active = 'schedules';

        return view('admin.schedules.ensembles.show', compact('admin_active','table'));
    }

    /**
     * Show the form for editing ensemble timeslots.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.schedules.ensembles.edit', ['admin_active' => 'schedules']);
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
}
