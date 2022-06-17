<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        //quick exit
        if(! auth()->user()->isAdmin){ abort(404);}

        return view('admin.index');
    }
}
