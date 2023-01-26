<?php

namespace App\Http\Controllers;

use App\Models\Admonition;
use App\Http\Requests\StoreAdmonitionRequest;
use App\Http\Requests\UpdateAdmonitionRequest;

class AdmonitionController extends Controller
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
     * @param  \App\Http\Requests\StoreAdmonitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmonitionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admonition  $admonition
     * @return \Illuminate\Http\Response
     */
    public function show(Admonition $admonition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admonition  $admonition
     * @return \Illuminate\Http\Response
     */
    public function edit(Admonition $admonition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdmonitionRequest  $request
     * @param  \App\Models\Admonition  $admonition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmonitionRequest $request, Admonition $admonition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admonition  $admonition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admonition $admonition)
    {
        //
    }
}
