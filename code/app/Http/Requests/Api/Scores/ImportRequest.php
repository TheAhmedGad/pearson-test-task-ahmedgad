<?php

namespace App\Http\Requests\Api\Scores;

use App\Rules\ValidateScoreCsvHeader;
use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Assuming you're logged in and authorized to take the action
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'csv_file' => ['bail','required','file','max:5120','mimes:csv', new ValidateScoreCsvHeader()]
        ];
    }
}
