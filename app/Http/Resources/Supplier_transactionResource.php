<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Supplier_transactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'request_from'=>$this->request_from,
            'inventory_id'=>$this->inventory_id,
            'supplier_id'=>$this->supplier_id,
            'count'=>$this->count,
            'total_amount'=>$this->total_amount,
            'payment_id'=>$this->payment_id,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updsted_at,
        ];
    }
}
