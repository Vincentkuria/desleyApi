<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validated($request->all());
        $spare=Spare::create($request->all());
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
        $spare->update($request->all());
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
}
