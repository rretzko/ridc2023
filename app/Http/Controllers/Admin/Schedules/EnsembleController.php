<?php

namespace App\Http\Controllers\Admin\Schedules;

use App\Exports\EnsembleScheduleExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\Tables\DaytimeEnsemblesTable;
use App\Models\Tables\EnsemblesTable;
use App\Models\Utility\Timeslot;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
     * Display form for editing Ensemble NB: NOT times schedule edit; only Ensemble name/Category edit
     *
     * @param Ensemble $ensemble
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showEnsemble(Ensemble $ensemble)
    {
        $categories = Category::all();
        $daytimeTable = new DaytimeEnsemblesTable('2023-03-25 09:00:00','2023-03-25 17:00:00',20);
        $tableObj = new EnsemblesTable;
        $table = $tableObj->table();

        $admin_active = 'schedules';

        return view('admin.schedules.ensembles.showEnsemble', compact('admin_active', 'categories', 'table', 'ensemble'));
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
     * Download csv following $this->show() with blanks
     * @return void
     */
    public function csv()
    {
        return Excel::download(new EnsembleScheduleExport('2023-03-25 09:00:00', '2023-03-25 17:00:00'), 'ensembleSchedule_'.date('Ymd_Gis').'.csv');
    }

    public function updateEnsemble(Request $request, Ensemble $ensemble)
    {
        $inputs = $request->validate(
            [
                'ensemble_name' => ['required','string'],
                'category_id' => ['required', 'exists:categories,id'],
            ]
        );

        $ensemble->update(
            [
                'ensemble_name' => $inputs['ensemble_name'],
                'category_id' => $inputs['category_id'],
            ]
        );

        return $this->index();
    }
}
