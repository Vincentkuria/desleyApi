<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $request->validated($request->all());
        $img_url=$request->file('img')->store('public');
        $service=Service::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'service_description'=>$request->service_description,
            'img_url'=>url(str_replace("public","storage",$img_url)),
            // 'inventory_id'=>$request->inventory_id,
        ]);
        return new ServiceResource($service);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return new ServiceResource($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return $this->success('','service deleted successfully');
    }

    public function search(Request $request) {
        if (request('search')) {
            return ServiceResource::collection(Service::where('name','like','%'.request('search').'%')->get());
        }  
        
    }
}
