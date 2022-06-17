<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendingemail;
use App\Services\TransactionEmailService;
use Illuminate\Http\Request;

class PendingemailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending = Pendingemail::all();

        return view('admin.pendingemails.index', compact('pending'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendingemail $pendingemail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendingemail $pendingemail=NULL, $recursive=false)
    {
        $mssgs = [];

        if ($pendingemail) { //user wants a specific email sent

            $mssgs[] = $this->sendEmail($pendingemail);

        } else { //user wants ALL pending emails sent

            foreach (Pendingemail::all() as $pendingemail) {

                $mssgs[] = $this->sendEmail($pendingemail);
            }
        }

        return back()->with('success', implode("<br />", $mssgs));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  /App/Models/Pendingemail $pendingemail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendingemail $pendingemail, $internal=false)
    {
        $pendingemailtype = $pendingemail['pendingemailtype'];
        $user = $pendingemail['user'];

        $pendingemail->delete();

        return ($internal) ? '' : back()->with('success',ucwords($pendingemailtype->descr).' email to: '.$user->name.' removed from queue.');
    }

    private function sendEmail($pendingemail)
    {
        $pendingemailtype = $pendingemail['pendingemailtype'];
        $user = $pendingemail['user'];
        $mssg = ucwords($pendingemailtype->descr) . ' scheduled to be sent to: ' . $user->name . '.';

        //send the email
        new TransactionEmailService($pendingemailtype, $user);

        //delete pending email record
        $pendingemail->delete();

        return $mssg;
    }
}
