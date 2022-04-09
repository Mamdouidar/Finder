<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'type' => 'reports',
            'attributes' => [
                'name' => $this->name,
                'national_id' => $this->national_id,
                'age' => $this->age,
                'area' => $this->area,
                'clothes_last_seen_wearing' => $this->clothes_last_seen_wearing,
                'gender' => $this->gender,
                'birthmark' => $this->birthmark,
                'picture' => $this->picture,
                'picture_url' => env('APP_URL') . 'storage' . $this->picture,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
