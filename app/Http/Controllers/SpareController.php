<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpareRequest;
use App\Http\Resources\SpareResource;
use App\Models\Spare;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SpareController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SpareResource::collection(Spare::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpareRequest $request)
    {
        $request->validated($request->all());
        $img_url=$request->file('img')->store('public');
        $spare=Spare::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'item_description'=>$request->item_description,
            'img_url'=>url(str_replace("public","storage",$img_url)),
            'inventory_id'=>$request->inventory_id,
        ]);

        return new SpareResource($spare);
    }

    /**
     * Display the specified resource.
     */
    public function show(Spare $spare)
    {
        return new SpareResource($spare);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spare $spare)
    {
        $img_url=$request->file('img')->store('public');
        $spare->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'item_description'=>$request->item_description,
            'img_url'=>url(str_replace("public","storage",$img_url)),
        ]);
        return new SpareResource($spare);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spare $spare)
    {
        $spare->delete();
        return $this->success('','spare deleted successfully');
    }

    public function search(Request $request) {
        if (request('search')) {
            return SpareResource::collection(Spare::where('name','like','%'.request('search').'%')->get());
        }  
        
    }
}
