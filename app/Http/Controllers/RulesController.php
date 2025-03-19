<?php

namespace App\Http\Controllers;

use App\Models\rules;
use App\Http\Requests\StorerulesRequest;
use App\Http\Requests\UpdaterulesRequest;

class RulesController extends Controller
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
     * @param  \App\Http\Requests\StorerulesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorerulesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function show(rules $rules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function edit(rules $rules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterulesRequest  $request
     * @param  \App\Models\rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterulesRequest $request, rules $rules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function destroy(rules $rules)
    {
        //
    }
}
