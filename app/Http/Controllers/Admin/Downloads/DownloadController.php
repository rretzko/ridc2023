<?php

namespace App\Http\Controllers\Admin\Downloads;

use App\Exports\EquipmentExport;
use App\Http\Controllers\Controller;
use App\Exports\StudentRosterExport;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function index()
    {
        return view('admin.downloads.index', ['admin_active' => 'downloads']);
    }

    /**
     * Download csv of current event's students
     * @return void
     */
    public function equipment()
    {
        return Excel::download(new EquipmentExport(), 'equipment_'.date('Ymd_Gis').'.csv');
    }

    /**
     * Download csv of current event's students
     * @return void
     */
    public function students()
    {
        return Excel::download(new StudentRosterExport(), 'studentRoster_'.date('Ymd_Gis').'.csv');
    }
}
