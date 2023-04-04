<?php

namespace App\Http\Controllers;

use App\Models\DefaultSchedule;
use App\Http\Requests\StoreDefaultScheduleRequest;
use App\Http\Requests\UpdateDefaultScheduleRequest;

class DefaultScheduleController extends Controller
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
     * @param  \App\Http\Requests\StoreDefaultScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDefaultScheduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefaultSchedule  $defaultSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultSchedule $defaultSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DefaultSchedule  $defaultSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(DefaultSchedule $defaultSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDefaultScheduleRequest  $request
     * @param  \App\Models\DefaultSchedule  $defaultSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDefaultScheduleRequest $request, DefaultSchedule $defaultSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefaultSchedule  $defaultSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefaultSchedule $defaultSchedule)
    {
        //
    }
}
