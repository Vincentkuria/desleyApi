<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    function total() {
        return Payment::all()->sum('amount');
    }

    function monthlyDeductions(){
        return Payment::where('amount','<',0)->whereBetween('created_at',[Carbon::now()->subDays(30),Carbon::now()])->sum('amount');
    }

    function monthlyIncome(){
        return Payment::where('amount','>',0)->whereBetween('created_at',[Carbon::now()->subDays(30),Carbon::now()])->sum('amount');
    }

    function approvedPayments(){
        return PaymentResource::collection(Payment::where('status->finance','approved')->get()); 
    
    }

    function pendingPayments() {
        return PaymentResource::collection(Payment::where('status->finance','pending')->get()); 
    }

    function searchWithName() {
        $payments =Payment::whereHas('customer', function ($query) {
        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%'.request('search').'%']);
        })->get();
        return PaymentResource::collection($payments);
    }

    function approvePayment(Request $request) {
        DB::table('payments')->where('id',$request->id)->update(['status->finance'=>'approved']);
        return $this->success('','payment approved');
    }

}
