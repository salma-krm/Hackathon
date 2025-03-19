<?php

namespace App\Http\Controllers;

use App\Models\Userrole;
use App\Http\Requests\StoreUserroleRequest;
use App\Http\Requests\UpdateUserroleRequest;

class UserroleController extends Controller
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
     * @param  \App\Http\Requests\StoreUserroleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserroleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function show(Userrole $userrole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function edit(Userrole $userrole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserroleRequest  $request
     * @param  \App\Models\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserroleRequest $request, Userrole $userrole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userrole $userrole)
    {
        //
    }
}
