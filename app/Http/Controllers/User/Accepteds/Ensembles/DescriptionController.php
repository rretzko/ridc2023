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
                'ensemble_name' => ['required','string','max:60'],
            ]
        );

        $ensemble->update(
            [
                'descr' => $request['descr'],
                'ensemble_name' => $request['ensemble_name'],
            ]
        );

        $success = $ensemble->ensemble_name.' has been updated.';

        return redirect(route('users.ensembles.edit', ['ensemble' => $ensemble, 'action' => 'descr']))
            ->with('success', $success);
    }
}
