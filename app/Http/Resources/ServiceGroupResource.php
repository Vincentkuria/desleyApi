<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceGroupResource extends JsonResource
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
            'name'=>$this->name,
            'supervisor'=>Employee::find($this->supervisor),
            'job'=>$this->job!==null ? Shipping::find($this->job) : null,
        ];
    }
}
