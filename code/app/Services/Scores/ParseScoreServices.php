<?php

namespace App\Services\Scores;

class ParseScoreServices
{
    protected array $studentSubjects = [];

    /**
     * Read CSV file
     *
     * @param \SplFileInfo $file
     *
     * @return $this
     */
    public function readCsvFile(\SplFileInfo $file): ParseScoreServices
    {
        $pointer = fopen($file, 'r');
        $header = fgetcsv($pointer);

        $this->studentSubjects = [];
        while (($row = fgetcsv($pointer)) !== false) {
            $data = array_combine($header, $row);
            if (!$subject = ScoringFactory::make($data['Subject']))
                continue;

            $identifier = $data['Student ID'] . '-' . $data['Subject'];

            //Create the data object for the first time if not exists
            if (!isset($this->studentSubjects[$identifier])) {
                $this->studentSubjects[$identifier] = [
                    'student_id' => (int)$data['Student ID'],
                    'name' => $data['Name'],
                    'subject' => $subject,
                    'scores' => [],
                ];
            }

            //Add score for existing data object 
            $this->studentSubjects[$identifier]['scores'][] = [
                'learning_objective' => $data['Learning Objective'],
                'score' => is_numeric($data['Score']) ? (int)$data['Score'] : $data['Score'],
            ];
        }

        fclose($pointer);

        //remove the identifier from final results array
        $this->studentSubjects = array_values($this->studentSubjects);

        return $this;
    }

    /**
     * Sort resulted data
     *
     * @return $this
     */
    public function sortDataByScore(): ParseScoreServices
    {
        foreach ($this->studentSubjects as &$studentSubject) {
            usort($studentSubject['scores'], fn($a, $b) =>
                $studentSubject['subject']->getSortValue($b['score']) <=> $studentSubject['subject']->getSortValue($a['score'])
            );
        }

        return $this;
    }

    /**
     * Return results
     *
     * @return array
     */
    public function results(): array
    {
        return $this->studentSubjects;
    }
}