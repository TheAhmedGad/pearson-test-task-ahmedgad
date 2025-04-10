<?php

namespace App\Services\Scores\Subjects;

use App\Services\Scores\ScoringScaleContract;
use App\Services\Scores\SubjectContract;

class Maths implements SubjectContract, ScoringScaleContract
{
    public function getName(): string
    {
        return 'Maths';
    }

    public function scale(): array
    {
        return ['F', 'E', 'D', 'C', 'B', 'A'];
    }

    public function getSortValue(string|int $score): int
    {
        return array_search($score, $this->scale());
    }

}