<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'national_id' => $this->national_id,
                'email' => $this->email,
                'gender' => $this->gender,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
                'picture' => $this->picture,
                'picture_url' => env('APP_URL') . 'storage' . $this->picture,
                'created_at' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
