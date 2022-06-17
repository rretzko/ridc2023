<?php

namespace App\Http\Controllers\Admin\Rosters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RostersController extends Controller
{
    public function index()
    {
        $admin_active = 'rosters';

        return view('admin.rosters.index',compact('admin_active'));
    }
}
