<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
            'email' => $this->email,
            'password' => $this->password,
            'usertype'=>$this->usertype,
            'image'=>$this->image,
            'google_id'=>$this->google_id,


           
        ];
    }
}
