<?php

namespace App\Services\Scores;

class ScoringFactory
{
    /**
     * Creating Subject instance
     *
     * @param string $subject
     *
     * @return SubjectContract|null
     */
    public static function make(string $subject): ?SubjectContract
    {
        $subject = strtolower($subject);
        $subjectClass = 'App\\Services\\Scores\\Subjects\\' . ucfirst($subject);
        if (!class_exists($subjectClass)){
            /*
             * Here, assuming simple scenario where ignoring the row when subject isn't configured,
             * But may businessmen requirement is to throw Exception or return validation error which leads us to better approach
             * */
            return null;
        }

        $instance = new $subjectClass();
        if (!$instance instanceof SubjectContract)
            return null;

        return $instance;
    }
}