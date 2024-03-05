<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
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
            'customer_id'=>$this->customer_id,
            'shipping_address'=>$this->shipping_address,
            'equipment_id'=>$this->equipment_id,
            'spare_id'=>$this->spare_id,
            'shipped_by'=>$this->shipped_by,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
