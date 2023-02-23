<?php

namespace App\Http\Controllers;

use App\Models\Electronic;
use App\Http\Requests\StoreElectronicRequest;
use App\Http\Requests\UpdateElectronicRequest;

class ElectronicController extends Controller
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
     * @param  \App\Http\Requests\StoreElectronicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreElectronicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Electronic  $electronic
     * @return \Illuminate\Http\Response
     */
    public function show(Electronic $electronic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Electronic  $electronic
     * @return \Illuminate\Http\Response
     */
    public function edit(Electronic $electronic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateElectronicRequest  $request
     * @param  \App\Models\Electronic  $electronic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateElectronicRequest $request, Electronic $electronic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Electronic  $electronic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Electronic $electronic)
    {
        //
    }
}
