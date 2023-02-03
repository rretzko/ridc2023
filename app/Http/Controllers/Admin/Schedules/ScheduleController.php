<?php

namespace App\Http\Controllers\Admin\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('admin.schedules.index', ['admin_active' => 'schedules']);
    }
}
