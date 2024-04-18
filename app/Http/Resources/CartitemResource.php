<?php

namespace App\Http\Resources;

use App\Models\Equipment;
use App\Models\Service;
use App\Models\Spare;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartitemResource extends JsonResource
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
            'equipment'=>Equipment::find($this->equipment_id),
            'service'=>Service::find($this->service_id),
            'spare'=>Spare::find($this->spare_id),
            'count'=>$this->count,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
