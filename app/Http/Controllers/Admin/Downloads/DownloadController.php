<?php

namespace App\Http\Controllers\Admin\Downloads;

use App\Exports\EquipmentExport;
use App\Http\Controllers\Controller;
use App\Exports\StudentRosterExport;
use App\Services\EnsemblesTxtService;
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
     * text download for Mark Witzling to provide the program
     * @return void
     */
    public function programFile()
    {
        $fileName = 'ensembles_'
            .date('Ynd', strtotime('NOW'))
            .'_'.date('gis', strtotime('NOW'))
            .'.txt';

        $service = new EnsemblesTxtService;

        self::export($fileName, $service->txt());


    }

    /**
     * Download csv of current event's students
     * @return void
     */
    public function students()
    {
        return Excel::download(new StudentRosterExport(), 'studentRoster_'.date('Ymd_Gis').'.csv');
    }

    protected function export($fileName, $txt){

        header("Content-Description: File Transfer");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Disposition: attachment; filename=\"".$fileName."\"");
        header('Content-Type: text/plain; charset=utf-16');
        header("Expires: 0");
        header("Pragma: public");

        echo $txt;
    }
}
