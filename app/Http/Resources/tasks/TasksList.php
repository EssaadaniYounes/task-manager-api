<?php

namespace App\Http\Resources\tasks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "short_description" => substr($this->description,0 , 25),
            "description" => $this->description,
            "status" => $this->status,
            "due_date" => $this->due_date,
        ];
    }
}
