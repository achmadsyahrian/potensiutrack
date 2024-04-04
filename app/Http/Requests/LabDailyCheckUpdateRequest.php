<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabDailyCheckUpdateRequest extends FormRequest
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
            'mandatory_user_id' => 'required',
            'optional_user_id' => 'nullable',
            'results' => 'nullable|array',
            'descriptions' => 'nullable|array',
            'descriptions.*.*' => 'nullable|string',
        ];
    }
}
