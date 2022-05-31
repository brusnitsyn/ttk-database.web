<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Filters\MachineTypeFilter;
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
    public function index(MachineTypeFilter $filter)
    {
        $types = MachineType::filter($filter)->paginate();
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brandId' => ['required', 'numeric'],
        ]);

        $machineType = new MachineType;

        $machineType->name = $request->name;
        $machineType->brand_id = $request->brandId;

        $machineType->save();

        return new MachineTypeResource($machineType);
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
