<?php

namespace App\Http\Controllers;

use App\Models\Accesory;
use App\Http\Requests\StoreAccesoryRequest;
use App\Http\Requests\UpdateAccesoryRequest;

class AccesoryController extends Controller
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
     * @param  \App\Http\Requests\StoreAccesoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccesoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accesory  $accesory
     * @return \Illuminate\Http\Response
     */
    public function show(Accesory $accesory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accesory  $accesory
     * @return \Illuminate\Http\Response
     */
    public function edit(Accesory $accesory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccesoryRequest  $request
     * @param  \App\Models\Accesory  $accesory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccesoryRequest $request, Accesory $accesory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accesory  $accesory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accesory $accesory)
    {
        //
    }
}
