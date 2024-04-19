<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabUsageStoreRequest extends FormRequest
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
            'lab_id' => 'required|exists:labs,id',
            'lecturer_id' => 'required|exists:users,id',
            'course' => 'required',
            'course_topic' => 'required',
            'course_credits' => 'required',
            'class' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'lab_assistant_signature' => 'required',
        ];
    }
}
