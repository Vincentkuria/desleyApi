<?php

namespace App\Http\Controllers;

use App\Http\Resources\Supplier_transactionResource;
use App\Models\SupplierTransaction;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

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
            'request_from'=>'required',
            'inventory_id'=>'required',
            'supplier_id'=>'required',
            'count'=>'required',
        ]);

        $transaction=SupplierTransaction::create($request->all());
        return new Supplier_transactionResource($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierTransaction $transaction)
    {
        return new Supplier_transactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierTransaction $transaction)
    {
        $transaction->update($request->all());
        return new Supplier_transactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierTransaction $transaction)
    {
        $transaction->delete();
        return $this->success('','transaction deleted successfully');
    }
}
