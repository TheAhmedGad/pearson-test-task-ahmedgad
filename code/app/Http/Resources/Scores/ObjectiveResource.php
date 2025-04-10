<?php

namespace App\Http\Resources\Scores;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObjectiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'learning_objective' => $this['learning_objective'],
            'score' => $this['score'],
        ];
    }
}
