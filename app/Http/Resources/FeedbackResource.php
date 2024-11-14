<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            'message'=>$this->message,
            'sender'=>$this->sender,
            'receiver'=>Employee::where('id',$this->receiver)->first(),
            'reply'=>Feedback::where('id',$this->reply)->first(),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
