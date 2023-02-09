<?php

namespace App\Http\Controllers\Admin\Status;

use App\Http\Controllers\Controller;
use App\Models\Tables\StatusTable;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $table = new StatusTable;
        return view('admin.status.index', ['admin_active' => "home", 'table' => $table->table()]);
    }

}
