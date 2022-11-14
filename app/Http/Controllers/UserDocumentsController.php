<?php

namespace App\Http\Controllers;

use App\Models\UserDocuments;
use App\Http\Requests\StoreUserDocumentsRequest;
use App\Http\Requests\UpdateUserDocumentsRequest;

class UserDocumentsController extends Controller
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
     * @param  \App\Http\Requests\StoreUserDocumentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserDocumentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDocuments  $userDocuments
     * @return \Illuminate\Http\Response
     */
    public function show(UserDocuments $userDocuments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDocuments  $userDocuments
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDocuments $userDocuments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserDocumentsRequest  $request
     * @param  \App\Models\UserDocuments  $userDocuments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserDocumentsRequest $request, UserDocuments $userDocuments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDocuments  $userDocuments
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDocuments $userDocuments)
    {
        //
    }
}
