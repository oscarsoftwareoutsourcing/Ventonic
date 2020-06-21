<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => date("Y-m-d H:i:s", strtotime($this->start_at)),
            'end' => date("Y-m-d H:i:s", strtotime($this->end_at)),
            'description' => $this->notes ?? null,
            'category' => $this->category ?? 'O',
            'place' => $this->place ?? null,
            'color' => $this->category_color,
            'dataEventColor' => $this->category_color_class
        ];
    }
}
