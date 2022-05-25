<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MachineTypeResource;
use App\Models\MachineType;
use Illuminate\Http\Request;

class MachineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = MachineType::paginate();
        return MachineTypeResource::collection($types->loadMissing('brand'));
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
     * @param  \App\Models\MachineType  $machineType
     * @return \Illuminate\Http\Response
     */
    public function show(MachineType $machineType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MachineType  $machineType
     * @return \Illuminate\Http\Response
     */
    public function edit(MachineType $machineType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MachineType  $machineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MachineType $machineType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MachineType  $machineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MachineType $machineType)
    {
        //
    }
}
