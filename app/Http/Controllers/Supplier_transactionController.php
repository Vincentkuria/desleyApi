<?php

namespace App\Http\Controllers;

use App\Http\Resources\Supplier_transactionResource;
use App\Http\Resources\SupplierTansactionReportResource;
use App\Models\SupplierTransaction;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $data['price']=DB::table('inventories')->where('id',$request->inventory_id)->first()->price*-1;
        

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
        return Supplier_transactionResource::collection(DB::table('supplier_transactions')->where('status->manager','approved')->where('supplier_id',$request->user()->id)->whereNull('status->supply')->get());
    }

    public function inventoryDelivered() {
        $inventory=DB::table('inventories')->where('id',request('inventory_id'))->first();
        $currentCount=$inventory->no_of_items;
        $newCount=$currentCount + request('no_of_items');
        $supplierId=SupplierTransaction::find(request('suptransaction_id'))->supplier_id;
        DB::table('inventories')->where('id',request('inventory_id'))->update(['no_of_items'=>$newCount,'supplier_id'=>$supplierId]);
        DB::table('supplier_transactions')->where('id',request('suptransaction_id'))->update(['status->supply'=>'done']);
        SupplierTransaction::find(request('suptransaction_id'))->update(['price'=>request('price')]);
        return $this->success('','updated successfuly');
    }

    public function approve() {
        SupplierTransaction::where('id',request('id'))->update(['status->manager'=>'approved']);
        return $this->success('','transaction approved successfully');
    }

    public function cancel() {
        SupplierTransaction::where('id',request('id'))->update(['status->manager'=>'cancelled']);
        return $this->success('','transaction canceled successfully');
    }

    function allSupplierResource() {
        return SupplierTansactionReportResource::collection(SupplierTransaction::all());
    }
}
