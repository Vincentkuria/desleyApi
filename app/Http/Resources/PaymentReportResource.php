<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'payment_code'=> $this->Payment_code,
            'customer'=>$this->customer == null ? null : Customer::find($this->customer_id),
            'supplier'=>$this->supplier == null ? null : Supplier::find($this->supplier_id),
            'amount'=>$this->amount<0 ? abs($this->amount) : $this->amount,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];;
    }
}
