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
            'customer'=>Customer::find($this->customer_id),
            'shipping_address'=>$this->shipping_address,
            'equipment'=>Equipment::find($this->equipment_id),
            'spare'=>Spare::find($this->spare_id),
            'service'=>Service::find($this->service_id),
            'shipped_by'=>$this->shipped_by,
            'status'=>$this->status,
            'count'=>$this->count,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'assigned'=>$this->assigned
        ];
    }
}
