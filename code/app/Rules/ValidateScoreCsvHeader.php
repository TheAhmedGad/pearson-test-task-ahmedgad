<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateScoreCsvHeader implements ValidationRule
{
    protected array $requiredHeaders = [
        'Student ID',
        'Name',
        'Learning Objective',
        'Score',
        'Subject',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pointer = fopen($value, 'r');
        $header = fgetcsv($pointer);
        fclose($pointer);

        $normalizedHeader = array_map(fn($h) => strtolower(trim($h)), $header);
        $normalizedRequired = array_map('strtolower', $this->requiredHeaders);

        $missing = array_filter($normalizedRequired, fn($req) => !in_array($req, $normalizedHeader));

        if (!empty($missing)) {
            $fail('CSV header is missing required columns: ' . implode(', ', $missing));
        }
    }
}
