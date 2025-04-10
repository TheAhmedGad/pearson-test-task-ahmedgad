# 📊 Pearson Technical Test

This project parses a CSV of student scores and outputs structured JSON per student, grouped by subject and sorted according to custom scoring logic.

---

## Quick Start

```bash
git clone https://github.com/TheAhmedGad/pearson-test-task-ahmedgad.git
cd pearson-test-task-ahmedgad
cp .env.example .env
```


## Using Docker
```bash
docker compose up -d
docker compose exec pearson_test_backend /bin/bash 
cp .env.example .env
```

## Scalability: Adding New Subjects
The project is built using the Strategy Design Pattern, making it easy to support new subjects and custom scoring rules.

To add a new subject:

Create a new strategy class in `App\Services\Scores\Subjects`, e.g.:

```php
<?php

namespace App\Services\Scores\Subjects;

use App\Services\Scores\ScoringScaleContract;
use App\Services\Scores\SubjectContract;

class History implements SubjectContract, ScoringScaleContract
{
    public function getName(): string
    {
        return 'History';
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
```

Please note that new subject must follow the same name of subject in csv file with first letter capital,
otherwise it will be ignored