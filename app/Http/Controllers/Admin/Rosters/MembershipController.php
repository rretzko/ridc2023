<?php

namespace App\Http\Controllers\Admin\Rosters;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function index()
    {
        $admin_active = 'rosters';
        $roster_active = 'membership';

        return view('admin.rosters.memberships.index',
            compact('admin_active','roster_active')
        );
    }
}
