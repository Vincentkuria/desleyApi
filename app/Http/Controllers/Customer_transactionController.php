<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customer_transactionResource;
use App\Models\CustomerTransaction;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class Customer_transactionController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer_transactionResource::collection(CustomerTransaction::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'payment_id'=>'required',
        ]);
        $transaction=CustomerTransaction::create($request->all());
        return new Customer_transactionResource($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerTransaction $transaction)
    {
        return new Customer_transactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerTransaction $transaction)
    {
        $transaction->update($request->all());
        return new Customer_transactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerTransaction $transaction)
    {
        $transaction->delete();
        return $this->success('','transaction deleted successfully');
    }
}
