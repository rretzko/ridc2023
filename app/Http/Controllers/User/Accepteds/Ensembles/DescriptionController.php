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
                'descr' => ['required','string'],
                'ensemble_name' => ['required','string','max:60'],
                'directed_by' => ['required','string','max:60'],
            ]
        );

        $ensemble->update(
            [
                'descr' => $request['descr'],
                'ensemble_name' => $request['ensemble_name'],
                'directed_by' => $request['directed_by'],
            ]
        );

        $success = $ensemble->ensemble_name.' has been updated.';

        return redirect(route('users.ensembles.edit', ['ensemble' => $ensemble, 'action' => 'descr']))
            ->with('success', $success);
    }
}
