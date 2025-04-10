<?php

namespace App\Http\Resources\Scores;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student_id' => $this['student_id'],
            'name' => $this['name'],
            'subject' => $this['subject']->getName(),
            'scores' => ObjectiveResource::collection($this['scores'])
        ];
    }
}
