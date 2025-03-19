<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Http\Requests\StoreHackathonRequest;
use App\Http\Requests\UpdateHackathonRequest;

class HackathonController extends Controller
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
     * @param  \App\Http\Requests\StoreHackathonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHackathonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hackathon  $hackathon
     * @return \Illuminate\Http\Response
     */
    public function show(Hackathon $hackathon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hackathon  $hackathon
     * @return \Illuminate\Http\Response
     */
    public function edit(Hackathon $hackathon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHackathonRequest  $request
     * @param  \App\Models\Hackathon  $hackathon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHackathonRequest $request, Hackathon $hackathon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hackathon  $hackathon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hackathon $hackathon)
    {
        //
    }
}
