<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnreportedIncidentResource extends JsonResource
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
            'type' => 'unreported_incidents',
            'attributes' => [
                'area' => $this->area,
                'gender' => $this->gender,
                'police_station' => $this->police_station,
                'picture' => $this->picture,
                'picture_url' => env('APP_URL') . $this->picture,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
