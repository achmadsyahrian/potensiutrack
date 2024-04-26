<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NetworkDevelopmentStoreRequest extends FormRequest
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
            'reported_by_id' => 'required|exists:users,id',
            'network_expansion_reason' => 'required',
            'puskom_signature' => 'required',
            'reporter_signature' => 'required',
            'status' => '',
        ];
    }
}
