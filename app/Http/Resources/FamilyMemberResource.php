<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FamilyMemberResource extends JsonResource
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
            'type' => 'family_members',
            'attributes' => [
                'relation' => $this->relation,
                'name' => $this->name,
                'national_id' => $this->national_id,
                'age' => $this->age,
                'gender' => $this->gender,
                'picture' => $this->picture,
                'picture_url' => env('APP_URL') . $this->picture,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
