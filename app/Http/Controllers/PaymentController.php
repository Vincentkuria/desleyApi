<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PaymentResource::collection(Payment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_code'=>'required|string',
            'amount'=>'required',
        ]);

        $payment=Payment::create($request->all());
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());
        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return $this->success('','Payment deleted successfully');
    }
}
