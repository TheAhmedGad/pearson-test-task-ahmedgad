<?php

namespace App\Services\Scores\Subjects;

use App\Services\Scores\ScoringScaleContract;
use App\Services\Scores\SubjectContract;

class Science implements SubjectContract, ScoringScaleContract
{
    public function getName(): string
    {
        return 'Science';
    }

    public function scale(): array
    {
        return ['Very Poor', 'Poor', 'Average', 'Good', 'Excellent'];
    }

    public function getSortValue(string|int $score): int
    {
        return array_search($score, $this->scale());
    }
}