<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierTansactionReportResource extends JsonResource
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
            'request_from'=>Employee::find($this->request_from),
            'inventory'=>Inventory::find($this->inventory_id),
            'supplier'=>Supplier::find($this->supplier_id),
            'count'=>$this->count,
            'status'=>$this->status,
            'price'=>$this->price<0?$this->price*-1:$this->price,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
