<?php

namespace App\Http\Controllers\User\Accepteds\Ensembles;

use App\Http\Controllers\Controller;
use App\Models\Ensemble;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    /**
     * @param Request $request
     * @param Ensemble $ensemble
     * @return void
     */
    public function update(Request $request, Ensemble $ensemble)
    {
        $request->validate(
            [
                'descr' => ['required','string', 'max:255'],
            ]
        );

        $ensemble->update(['descr' => $request['descr']]);

        return redirect(route('users.accepteds.ensembles.index', ['ensemble' => $ensemble]));
    }
}
