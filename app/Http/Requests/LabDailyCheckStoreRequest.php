<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabDailyCheckStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'lab_id' => 'required',
            'mandatory_user_id' => 'required',
            'optional_user_id' => 'nullable',
            'date' => 'required|date',
            'results' => 'nullable|array',
            'descriptions' => 'nullable|array',
            'descriptions.*.*' => 'nullable|string',
        ];

    }
}
