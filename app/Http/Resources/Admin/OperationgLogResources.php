<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OperationgLogResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data         = parent::toArray($request);
        $data['user'] = new UserResources($this->whenLoaded('user'));

        return $data;
    }
}
