<?php

namespace App\Http\Controllers\User\Accepteds\Applications;

use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\Utility\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function show()
    {
        $application = new Application;
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();

        return (auth()->user()->accepted())
            ? view('users.accepteds.applications.show', compact('application', 'event', 'school', 'user'))
            : view('users.application.edit', compact('application', 'event'));
    }
}
