<?php

namespace App\Http\Controllers;

use App\Models\Safety;
use App\Http\Requests\StoreSafetyRequest;
use App\Http\Requests\UpdateSafetyRequest;

class SafetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSafetyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSafetyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function show(Safety $safety)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function edit(Safety $safety)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSafetyRequest  $request
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSafetyRequest $request, Safety $safety)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function destroy(Safety $safety)
    {
        //
    }
}
