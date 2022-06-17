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
        $users = User::orderBy('last')->orderBy('first')->select('id', 'last','first','middle')->paginate(15);
        $admin_active = 'rosters';
        $roster_active = 'membership';

        return view('admin.rosters.memberships.index', compact('admin_active','roster_active','users'));
    }
}
