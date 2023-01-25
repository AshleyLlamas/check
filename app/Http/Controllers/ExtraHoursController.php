<?php

namespace App\Http\Controllers;

use App\Models\ExtraHours;
use App\Http\Requests\StoreExtraHoursRequest;
use App\Http\Requests\UpdateExtraHoursRequest;

class ExtraHoursController extends Controller
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
     * @param  \App\Http\Requests\StoreExtraHoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtraHoursRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExtraHours  $extraHours
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraHours $extraHours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExtraHours  $extraHours
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraHours $extraHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExtraHoursRequest  $request
     * @param  \App\Models\ExtraHours  $extraHours
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExtraHoursRequest $request, ExtraHours $extraHours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExtraHours  $extraHours
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtraHours $extraHours)
    {
        //
    }
}
