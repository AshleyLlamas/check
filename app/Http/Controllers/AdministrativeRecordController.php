<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeRecord;
use App\Http\Requests\StoreAdministrativeRecordRequest;
use App\Http\Requests\UpdateAdministrativeRecordRequest;

class AdministrativeRecordController extends Controller
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
     * @param  \App\Http\Requests\StoreAdministrativeRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdministrativeRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdministrativeRecord  $administrativeRecord
     * @return \Illuminate\Http\Response
     */
    public function show(AdministrativeRecord $administrativeRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdministrativeRecord  $administrativeRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(AdministrativeRecord $administrativeRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdministrativeRecordRequest  $request
     * @param  \App\Models\AdministrativeRecord  $administrativeRecord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdministrativeRecordRequest $request, AdministrativeRecord $administrativeRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdministrativeRecord  $administrativeRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdministrativeRecord $administrativeRecord)
    {
        //
    }
}
