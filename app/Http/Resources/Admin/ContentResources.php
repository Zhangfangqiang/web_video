<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data             = parent::toArray($request);
        $data['user']     = new UserResources($this->whenLoaded('user'));
        $data['category'] = new CategoryResources($this->whenLoaded('category'));

        return $data;
    }
}
