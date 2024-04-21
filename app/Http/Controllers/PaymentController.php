<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            'amount'=>'required',
        ]);
        $data= $request->all();
        $data['payment_code']=Str::uuid();
        if ($request->user() instanceof Customer) {
            $data['customer_id']=$request->user()->id;
        }elseif ($request->user() instanceof Supplier) {
            $data['supplier_id']=$request->user()->id;
        }
        $payment=Payment::create($data);
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
