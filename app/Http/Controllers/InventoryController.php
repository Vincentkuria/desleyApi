<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InventoryResource::collection(Inventory::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'no_of_items'=>'required',
        ]);

        $inventory=Inventory::create($request->all());
        return new InventoryResource($inventory);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return new InventoryResource($inventory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $inventory->update($request->all());
        return new InventoryResource($inventory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return $this->success('','Inventory deleted successfully');
    }

    public function statusRequestDelete() {
        DB::table('inventories')->where('id',request('deleteid'))->update(['status->manager'=>'delete']);
        return $this->success('','deleted sucessfully');
    }

    public function indexApproved()
    {
        return InventoryResource::collection(DB::table('inventories')->where('status->manager','approved')->get());
    }
}
