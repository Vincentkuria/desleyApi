<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerTransactionReportResource;
use App\Http\Resources\CustomerTransactionResource;
use App\Models\CustomerTransaction;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerTransactionResource::collection(CustomerTransaction::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_id'=>'required',
            'shipping_address'=>'required'
        ]);
        $data=$request->all();
        $data['customer_id']=$request->user()->id;
        $transaction=CustomerTransaction::create($data);
        return new CustomerTransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction=CustomerTransaction::find($id);
        return new CustomerTransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction=CustomerTransaction::find($id);
        $transaction->update($request->all());
        return new CustomerTransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction=CustomerTransaction::find($id);
        $transaction->delete();
        return $this->success('','transaction deleted successfully');
    }

    function allOrderReports() {
        return CustomerTransactionReportResource::collection(CustomerTransaction::whereNull('service_id')->get());
    }

    function allServiceReports() {
        return CustomerTransactionReportResource::collection(CustomerTransaction::whereNotNull('service_id')->get());
    }
}
