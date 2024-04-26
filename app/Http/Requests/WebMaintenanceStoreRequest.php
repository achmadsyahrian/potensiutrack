<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebMaintenanceStoreRequest extends FormRequest
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
            'date' => 'required|date',
            'division_id' => 'required|exists:divisions,id',
            'web_app_id' => 'required|exists:web_apps,id',
            'reported_by_id' => 'required|exists:users,id',
            'error' => 'required',
            'puskom_signature' => 'required',
            'reporter_signature' => 'required',
            'status' => '',
        ];
    }
}
