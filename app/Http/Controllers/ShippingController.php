<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShippingResource;
use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Inventory;
use App\Models\Shipping;
use App\Models\Spare;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function updateStatus(Request $request){

        $shippingId=request('id');
        $shipping=Shipping::find($shippingId);
        $equipmentId=$shipping->equipment_id;
        $spareId=$shipping->spare_id;
        $inventoryId=$equipmentId!=null ? Equipment::find($equipmentId)->inventory_id : Spare::find($spareId)->inventory_id;
        $oldNumber=Inventory::find($inventoryId)->no_of_items;
        $removingNumber=$shipping->count;
        $newNumber=$oldNumber-$removingNumber;
        Log::debug(request('status'));
        if (request('status')=='in transit') {
            DB::table('shippings')->where('id',request('id'))->update(['status->shipping_status'=>'in transit']);
        }
        if (request('status')=='delivered') {
            DB::table('shippings')->where('id',request('id'))->update(['status->shipping_status'=>'delivered']);
            DB::table('inventories')->where('id',$inventoryId)->update(['no_of_items'=>$newNumber]);
        }
        
    }

    public function serviceShipping(){
        return ShippingResource::collection(Shipping::whereNotNull('service_id')->where('assigned',false)->get());
    }

    public function searchShippings(){
        $column =request('column');
        $columnQuery=request('columnQuery');

        if ($column!=null){
            if ($columnQuery==null) {
                
                return ShippingResource::collection(Shipping::whereNull($column)->whereNull('service_id')->get());
            }
           return ShippingResource::collection(Shipping::where($column,$columnQuery)->get()); 
        }
    }

    function searchWithName() {
        $payments =Shipping::whereHas('customer', function ($query) {
        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%'.request('search').'%']);
        })->get();
        return ShippingResource::collection($payments);
    }

    public function driverItems(Request $request){
        return ShippingResource::collection(DB::table('shippings')->where('shipped_by',$request->user()->id)->where('status->shipping_status','in transit')->get());
    }
}
