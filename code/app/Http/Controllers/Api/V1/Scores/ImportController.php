<?php

namespace App\Http\Controllers\Api\V1\Scores;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Scores\ImportRequest;
use App\Http\Resources\Scores\SubjectResource;
use App\Services\Scores\ParseScoreServices;

class ImportController extends Controller
{
    public function __construct(protected ParseScoreServices $parseScoreServices)
    {
    }

    public function __invoke(ImportRequest $request)
    {
        return SubjectResource::collection($this->parseScoreServices
            ->readCsvFile($request->validated('csv_file'))
            ->sortDataByScore()
            ->results()
        );
    }
}
