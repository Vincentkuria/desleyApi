<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EquipmentResource::collection(Equipment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validated($request->all());
        $equipment=Equipment::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'item_description'=>$request->item_description,
            'img_url'=>$request->img_url,
            'video_url'=>$request->video_url,
            'inventory_id'=>$request->inventory_id,
        ]);

        return $this->success([
            'equipment'=>$equipment,
        ],'equipment stored successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return new EquipmentResource($equipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $equipment->update([$request->all()]);
        return new EquipmentResource($equipment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return $this->success('','Equipment deleted successfully');
    }
}
