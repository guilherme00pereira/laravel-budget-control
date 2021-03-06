<?php

namespace App\Http\Controllers;

use App\Models\RecurringType;
use Illuminate\Http\Request;

class RecurringTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rtypes = RecurringType::query()->orderBy('name')->get();
        return view('recurring_types.index', compact('rtypes'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecurringType  $recurringType
     * @return \Illuminate\Http\Response
     */
    public function show(RecurringType $recurringType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecurringType  $recurringType
     * @return \Illuminate\Http\Response
     */
    public function edit(RecurringType $recurringType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecurringType  $recurringType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecurringType $recurringType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecurringType  $recurringType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecurringType $recurringType)
    {
        //
    }
}
