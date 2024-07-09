<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function store(StoreEquipmentRequest $request)
    {
        $request->validated($request->all());
        $img_url=$request->file('img')->store('public');
        $equipment=Equipment::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'item_description'=>$request->item_description,
            'img_url'=>url(str_replace("public","storage",$img_url)),
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
    public function update(StoreEquipmentRequest $request, Equipment $equipment)
    {
        $img_url=$request->file('img')->store('public');
        $equipment->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'item_description'=>$request->item_description,
            'img_url'=>url(str_replace("public","storage",$img_url)),
        ]);
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

    public function search(Request $request) {
        if (request('search')) {
            return EquipmentResource::collection(Equipment::where('name','like','%'.request('search').'%')->get());
        }  
        
    }
}
