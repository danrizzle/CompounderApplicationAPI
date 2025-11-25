<?php

namespace App\Http\Requests;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
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
            Application::APPLICANT_NAME => ['required', 'string', 'max:255'],
            Application::COUNTRY_OF_ORIGIN => ['required', 'string', 'max:255'],
            Application::PROGRAM_TYPE => ['required', 'string'],
            Application::APPLICATION_TYPE => ['required', 'string'],
            Application::SUBMITTED_DOCUMENTS => ['required', 'array'],
            Application::SUBMITTED_DOCUMENTS . '.*' => ['string', 'max:255'],
        ];
    }
}
