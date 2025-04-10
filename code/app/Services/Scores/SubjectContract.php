<?php

namespace App\Services\Scores;

interface SubjectContract
{
    /**
     * Get Subject name and mutate it as needed
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get Sorting logic/Scale value
     *
     * @param string|int $score
     *
     * @return int
     */
    public function getSortValue(string|int $score): int;
}