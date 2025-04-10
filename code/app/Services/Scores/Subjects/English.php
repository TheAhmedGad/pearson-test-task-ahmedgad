<?php

namespace App\Services\Scores\Subjects;

use App\Services\Scores\SubjectContract;

class English implements SubjectContract
{
    public function getName(): string
    {
        return 'English';
    }

    public function getSortValue(string|int $score): int
    {
        return (int)$score;
    }
}