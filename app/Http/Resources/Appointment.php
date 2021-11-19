<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class Appointment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'title' => strtoupper($this->reason),
            'start' => $this->begin,
            'end' => $this->end,
            'session' => $this->session,
            'color' => $this->color,
            'textColor' => $this->textColor,
            'user_id' => $this->user_id,
            $this->mergeWhen(Auth::user()->isAdmin, [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]),
        ];
    }
}
