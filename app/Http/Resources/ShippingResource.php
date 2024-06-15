<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Service;
use App\Models\Spare;
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
            'equipment'=>Equipment::find($this->equipment_id),
            'spare'=>Spare::find($this->spare_id),
            'service'=>Service::find($this->spare_id),
            'shipped_by'=>$this->shipped_by,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
