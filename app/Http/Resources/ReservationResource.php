<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return[
            "id" => $this->id,
            "first_name"=> $this->first_name,
            "email"=> $this->email,
            "phone_number"=> $this->phone_number,
            "res_date"=> $this->res_date,
            "messages"=> $this->messages,

        ];
    }


}
