<?php

namespace App\Http\Controllers\Admin\Schedules;

use App\Exports\EnsembleScheduleExport;
use App\Exports\SoloistScheduleExport;
use App\Http\Controllers\Controller;
use App\Models\Tables\DaytimeSoloistsTable;
use App\Models\Tables\SoloistsTable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SoloistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = new SoloistsTable;

        return view('admin.schedules.soloists.index', ['admin_active' => 'schedules', 'table' => $table->table()]);
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
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $daytimeTable = new DaytimeSoloistsTable('2023-03-25 09:00:00','2023-03-25 17:00:00',8);
        $table = $daytimeTable->table();

        $admin_active = 'schedules';

        return view('admin.schedules.soloists.show', compact('admin_active','table'));

    }

    /**
     * Show the form for editing soloist timeslots.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.schedules.soloists.edit', ['admin_active' => 'schedules']);
    }

    /**
     * Download csv following $this->show() with blanks
     * @return void
     */
    public function csv()
    {
        return Excel::download(new SoloistScheduleExport('2023-03-25 09:00:00', '2023-03-25 17:00:00'), 'soloistSchedule_'.date('Ymd_Gis').'.csv');
    }
}
