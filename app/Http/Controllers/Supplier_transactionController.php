<?php

namespace App\Http\Controllers;

use App\Http\Resources\Supplier_transactionResource;
use App\Models\SupplierTransaction;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Supplier_transactionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Supplier_transactionResource::collection(SupplierTransaction::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id'=>'required',
            'supplier_id'=>'required',
            'count'=>'required',
        ]);

        $data=$request->all();
        $data['request_from']=$request->user()->id;
        

        $transaction=SupplierTransaction::create($data);
        return new Supplier_transactionResource($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction=SupplierTransaction::find($id);
        return new Supplier_transactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction=SupplierTransaction::find($id);
        $transaction->update($request->all());
        return new Supplier_transactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction=SupplierTransaction::find($id);
        $transaction->delete();
        return $this->success('','transaction deleted successfully');
    }

    public function indexApproved(Request $request) {
        return Supplier_transactionResource::collection(DB::table('supplier_transactions')->where('status->manager','approved')->where('supplier_id',$request->user()->id)->get());
    }

    public function inventoryDelivered() {
        $inventory=DB::table('inventories')->where('id',request('inventory_id'))->first();
        $currentCount=$inventory->no_of_items;
        $newCount=$currentCount + request('no_of_items');
        DB::table('inventories')->where('id',request('inventory_id'))->update(['no_of_items'=>$newCount]);
        DB::table('supplier_transactions')->where('id',request('suptransaction_id'))->update(['status->supply'=>'done']);
        return $this->success('','updated successfuly');
    }
}
