<?php

namespace App\Http\Controllers\Admin\Rosters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_active = 'rosters';
        $roster_active = 'invitees';

        return view('admin.rosters.invitees.index', compact('admin_active','roster_active'));
    }
}
