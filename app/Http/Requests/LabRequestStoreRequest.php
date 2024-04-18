<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabRequestStoreRequest extends FormRequest
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
            'course' => 'required',
            'date' => 'required|date',
            'scheduled_date' => 'required|date',
            'lab_assistant_signature' => 'required',
            'class' => 'required',
            'lecturer_id' => 'required|exists:users,id',
            'lab_id' => 'required|exists:labs,id',
            'description' => 'nullable',
        ];
    }
}
