<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeePcDailyCheckStoreRequest extends FormRequest
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
            'division_id' => 'required|exists:divisions,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'complaint' => 'nullable|string',
            'description' => 'nullable|string',
            'keyboard_condition' => 'nullable',
            'mouse_condition' => 'nullable',
            'monitor_condition' => 'nullable',
            'cpu_condition' => 'nullable',
            'internet_condition' => 'nullable',
            'printer_condition' => 'nullable',
            'scanner_condition' => 'nullable',
            'employee_signature' => 'required',
            'technician_signature' => 'required',
        ];
    }
}
