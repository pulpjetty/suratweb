<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
//    public function toArray($request)
//    {
//        return parent::toArray($request);
//    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstname,
            'lastName' => $this->lastname,
            'name' => $this->username,
            'email' => $this->email,
//            'password' => $this->password,
            'level' => $this->level,
//            'rememberToken' => $this->remember_token,
        ];
    }
}
