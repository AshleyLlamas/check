<?php

namespace App\Http\Controllers;

use App\Models\TimeCheck;
use App\Http\Requests\StoreTimeCheckRequest;
use App\Http\Requests\UpdateTimeCheckRequest;

class TimeCheckController extends Controller
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
     * @param  \App\Http\Requests\StoreTimeCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeCheckRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeCheck  $timeCheck
     * @return \Illuminate\Http\Response
     */
    public function show(TimeCheck $timeCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeCheck  $timeCheck
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeCheck $timeCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeCheckRequest  $request
     * @param  \App\Models\TimeCheck  $timeCheck
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeCheckRequest $request, TimeCheck $timeCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeCheck  $timeCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeCheck $timeCheck)
    {
        //
    }
}
