<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Spare;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerTransactionReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id'=>$this->id,
            'customer'=>Customer::find($this->customer_id),
            'payment'=>Payment::find($this->payment_id),
            'equipment'=>$this->equipment_id==null ? null : Equipment::find($this->equipment_id),
            'spare'=>$this->spare_id == null ? null : Spare::find($this->spare_id),
            'service'=>$this->service_id == null ? null : Service::find($this->service_id),
            'count'=>$this->count,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
