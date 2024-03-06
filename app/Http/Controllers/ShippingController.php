<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShippingResource;
use App\Models\Shipping;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShippingResource::collection(Shipping::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'shipping_address'=>'required',
        ]);

        $shipment=Shipping::create($request->all());
        return new ShippingResource($shipment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shipment=Shipping::find($id);
        return new ShippingResource($shipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shipment=Shipping::find($id);
        $shipment->update($request->all());
        return new ShippingResource($shipment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipment=Shipping::find($id);
        $shipment->delete();
        return $this->success('','shipment successfully deleted');
    }
}
