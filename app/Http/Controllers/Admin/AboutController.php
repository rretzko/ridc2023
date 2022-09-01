<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //quick exit
        if(! auth()->user()->isAdmin){ abort(404);}

        $abouts = About::orderBy('order_by')->get();

        return view('admin.abouts.index', ['admin_active' => 'home'], compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clean = $request->validate(
            [
                'descr' => ['required', 'string'],
                'order_by' => ['required', 'numeric'],
                'title' => ['required', 'string','unique:abouts'],
            ],
        );

        About::create($clean);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $abouts = About::orderBy('order_by')->get();

        return view('admin.abouts.edit', ['admin_active' => 'home'], compact('about','abouts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $clean = $request->validate(
            [
                'descr' => ['required', 'string'],
                'order_by' => ['required', 'numeric'],
                'title' => ['required', 'string',Rule::unique('abouts')->ignore($about->id)],
            ],
        );

        $about->update($clean);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
