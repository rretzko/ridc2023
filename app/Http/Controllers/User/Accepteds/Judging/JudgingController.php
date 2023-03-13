<?php

namespace App\Http\Controllers\User\Accepteds\Judging;

use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class JudgingController extends Controller
{
    public function show()
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $files = new FileUpload;
        $fileUploads = $files->myFiles;

        return view('users.accepteds.judging.show', compact('event', 'fileUploads', 'user'));
    }
}
